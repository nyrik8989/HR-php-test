<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use App\Partner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $orders = OrderResource::collection(Order::with([
            'partner', 'products',
        ])->paginate())->toArray($request);

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partners = Partner::all(['id', 'name']);
        $statuses = Order::STATUSES;

        $order = Order::whereId($id)
            ->with(['partner', 'orderProducts.product'])
            ->first();

        return view('order.edit', compact('order', 'partners', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //todo to Request class
        $request->validate([
            'client_email' => 'required|email:rfc,dns',
            'partner_id'   => 'required|exists:partners,id',
            'status'       => 'required|numeric',
        ]);

        $order = Order::whereId($id)->first();

        $order->client_email = $request->get('client_email');
        $order->partner_id   = $request->get('partner_id');
        $order->status       = $request->get('status');
        $order->save();

        return redirect(route('orders.show', $order));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
