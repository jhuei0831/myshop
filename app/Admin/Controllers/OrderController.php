<?php

namespace App\Admin\Controllers;

use PDF;
use App\Order;
use App\OrderItem;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Table;
use Dcat\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Order';

    public function index(Content $content)
    {
        return $content
            ->header('訂單管理')
            ->description('管理所有訂單')
            ->body($this->grid());

    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);
        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('address', __('Address'));
        $grid->column('total', __('Total'))->sortable();
        $grid->column('closed', __('Closed'))->bool();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('報價單')->display(function () {
            return "<a href='/admin/orders/pdf/{$this->getKey()}' target='_blank'>Print</a>";
        });
        $grid->column('訂單內容')->modal('訂單', function ($model) {
            // dd($model);
            $comments = OrderItem::where('order_id', $model->row->id)->get()->map(function ($comment) {
                return $comment->only(['product_id', 'amount','discount', 'price']);
            });
            return new Table([__('Product id'), __('Amount'),__('Discount'), __('Price')], $comments->toArray());
        });
        $grid->filter(function ($filter) {
            // 去掉默認的id過濾器
            $filter->disableIdFilter();
            // 在這里添加字段過濾器
            $filter->like('user_id', __('Order id'));
            // $filter->like('product_id', __('Product id'));
            $filter->between('created_at')->datetime();
        });

        // $grid->items('price')->toArray()->get('0')->get('price');
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('address', __('Address'));
        $show->field('total', __('Total'));
        $show->field('closed', __('Closed'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order);
        $form->number('user_id', __('User id'));
        // $form->number('items.1.price');
        $form->textarea('address', __('Address'));
        $form->number('total', __('Total'));
        $form->switch('closed', __('Closed'));

        return $form;
    }
    public function pdf($id)
    {
        $customer_data = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('order_id', $id)
            ->select('users.name', 'users.address', 'products.title', 'order_items.amount', 'order_items.price', 'order_items.discount')
            ->get();
        // $customer = DB::table('order_items')
        //     ->where('order_id', $customer_data[0]->order_id)
        //     ->get('price')->toArray();
        $output = '
            <h3 align="center">報價單</h3>
            <h1></h1>

            <h4 align="center">姓名 : ' . $customer_data[0]->name . '</h4>
            <h4 align="center">地址 : ' . $customer_data[0]->address . '</h4>
            <h1></h1>
            <table width="100%" style="border-collapse: collapse; border: 0px;">
            <tr>
                <th style="border: 1px; text-align:center; padding:12px;" width="50%">貨品名稱</th>
                <th style="border: 1px; text-align:center; padding:12px;" width="15%">數量</th>
                <th style="border: 1px; text-align:center; padding:12px;" width="15%">價格</th>
                <th style="border: 1px; text-align:center; padding:12px;" width="20%">備註</th>
            </tr>
            ';
        foreach ($customer_data as $customer) {
            $output .= '
            <tr>
            <td style="border: 1px; text-align:center; padding:12px;">' . $customer->title . '</td>
            <td style="border: 1px; text-align:center; padding:12px;">' . $customer->amount . '</td>
            <td style="border: 1px; text-align:center; padding:12px;">' . $customer->price*$customer->discount . '</td>
            <td style="border: 1px; text-align:center; padding:12px;"></td>
            </tr>
            ';
        }

        $output .= '</table>';
        PDF::SetFont('msungstdlight', '', 20);
        PDF::SetTitle($id . ' - 報價單');
        PDF::AddPage();
        PDF::writeHTML($output, true, false, true, false, '');
        return PDF::Output(uniqid() . '.pdf', 'I');

    }
    public function order_items($id)
    {
        $price = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('order_id', $id)
            ->get('price')->toArray();
        return $price;
    }

}
