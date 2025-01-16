<?php

namespace App\Http\Services;

use App\Repository\OrderRepositoryInterface;
use App\Repository\OrderBookRepositoryInterface;
use App\Repository\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Http;
use App\Http\Resources\OrderResource;

class OrderService
{
    public function __construct(
        private readonly OrderRepositoryInterface  $orderRepository,
        private readonly OrderBookRepositoryInterface  $orderBookRepository,
        private readonly BookRepositoryInterface  $BookRepository,
    )
    {
    }

    public function getAllOrdersForUser()
    {
        return OrderResource::collection($this->orderRepository->getAllOrdersForUser(auth()->user()->id));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try
        {
            $total_price = 0;
            $data['total_price'] = $total_price;
            $data['user_id'] = auth()->user()->id;
            $order = $this->orderRepository->create($data);
            foreach($request->books as $book)
            {
                $oldbook = $this->BookRepository->find($book['book_id']);
                if($oldbook)
                {
                    $total_price += $oldbook->price * $book['quantity'];
                }
                $data2['order_id'] = $order->id;
                $data2['book_id'] = $book['book_id'];
                $data2['quantity'] = $book['quantity'];
                $data2['price'] = $oldbook->price;
                if($oldbook->stock < $book['quantity'])
                {
                    return response()->json(['message' => 'Not enough quantity of book'], 400);
                }
                $orderBook = $this->orderBookRepository->create($data2);
                $this->BookRepository->update($oldbook->id,['stock' => $oldbook->stock - $book['quantity']]);
            }
            $this->orderRepository->update($order->id, ['total_price' => $total_price]);
            DB::commit();
            return response()->json(['message' => 'order is created'], 201);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return response()->json($e->getMessage(), 400);
        }
    }

    public function changeStatus($id,$request)
    {
        try
        {
            $order = $this->orderRepository->find($id);
            $this->orderRepository->update($id, ['status' => $request->status]);
            return response()->json(['message' => 'order is updated'], 200);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return response()->json($e->getMessage(), 400);
        }
    }
}
