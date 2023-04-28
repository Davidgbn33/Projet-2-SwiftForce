<?php

namespace App\Controller;

class BasketController extends AbstractController
{
    public function index(): string
    {
        if (isset($_SESSION['cart'])) {
            $total = 0;
            foreach ($_SESSION['cart'] as $cart) {
                $total += $cart['quantity'] * $cart['price'];
            }
            $totalLivraison = $total + 40;
        } else {
            $total = 0;
            $totalLivraison = $total + 40;
        }
        return $this->twig->render('basket/index.html.twig', ['total' => $total, 'totalLivraison' => $totalLivraison]);
    }

    //////////////// fonction de suppression d'un article du panier ////////////////
    public function delete($id)
    {
        if (!isset($id)) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $id = $_GET['id'];
            }
        }
        $key = 'product_' . $id;
        unset($_SESSION['cart'][$key]);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    //////////////// fonction de modification d'un panier ////////////////
    public function edit($id, $quantity)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $quantity = $_GET['quantity'];
            $key = 'product_' . $id;
<<<<<<< HEAD
            //Si la quantité est positive on modifie sinon on supprime l'article
            if ($quantity > 0) {
                $_SESSION['cart'][$key]['quantity'] = $quantity;
                $_SESSION['cart'][$key]['total'] = $quantity * $_SESSION['cart'][$key]['price'];
            } else {
                unset($_SESSION['cart'][$key]);
=======
            if (isset($_GET['quantityChange+'])) {
                $_SESSION['cart'][$key]['quantity'] = ++$quantity;
                $_SESSION['cart'][$key]['total'] = $quantity * $_SESSION['cart'][$key]['price'];
            } elseif (isset($_GET['quantityChange-'])) {
                if ($_SESSION['cart'][$key]['quantity'] > 1) {
                    $_SESSION['cart'][$key]['quantity'] = --$quantity;
                    $_SESSION['cart'][$key]['total'] = $quantity * $_SESSION['cart'][$key]['price'];
                } else {
                    unset($_SESSION['cart'][$key]);
                }
>>>>>>> develop
            }
        } else {
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }
        header('Location:/basket');
    }
}
