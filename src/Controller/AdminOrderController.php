<?php

namespace App\Controller;

use App\Model\AdminOrderManager;
use App\Model\StatusManager;

class AdminOrderController extends AbstractController
{
    public function index(): string
    {
        $status = new AdminOrderManager();
        $orderStatus = $status->selectAllOrderStatus();

        return $this->twig->render('Admin/listOrder.html.twig', [
            'orderStatus' => $orderStatus,
        ]);
    }

    public function show(int $orderStatus): string
    {
        $statusManager = new AdminOrderManager();
        $orderStatus = $statusManager->selectByIdOrder($orderStatus);

        return $this->twig->render('Admin/showOrder.html.twig', ['orderStatus' => $orderStatus]);
    }

    public function edit(int $orderStatus): string
    {
        $statusManager = new StatusManager();
        $statusLists = $statusManager->selectAll();
        $statusOrder = new AdminOrderManager();
        $orderStatus = $statusOrder->selectByIdOrder($orderStatus);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $statusList = array_map('trim', $_POST);

            // TODO validations (length, format...)
            // if validation is ok, update and redirection
            $orderStatus['status_id'] = $statusList['status'];
            $statusOrder->update($orderStatus);
            header('Location: /AdminOrder/index');
        }

        return $this->twig->render('Admin/editOrder.html.twig', [
            'orderStatus' => $orderStatus,
            'statusLists' => $statusLists,
        ]);
    }
}
