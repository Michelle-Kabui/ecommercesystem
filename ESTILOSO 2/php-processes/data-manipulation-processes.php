<?php

require("connect.php");
session_start();

if (isset($_POST['categories'])) {

    $category_name = $_POST["category_name"];

    $sql = "INSERT INTO `categories`(`category_name`) VALUES ('$category_name')";

    if (mysqli_query($conn, $sql)) {
        header("location:../php/categories.php?Warning= Category added Successfully");
    } else {
        header("location:../php/categories.php?Warning= There is an error = " . mysqli_error($conn));
    }
} elseif (isset($_POST['sub-categories'])) {

    $category_name = $_POST["category_name"];
    $sub_category_name = $_POST["sub_category_name"];

    $sql = "INSERT INTO `subcategories`(`category_name`,`sub_category_name`) VALUES ('$category_name','$sub_category_name')";

    if (mysqli_query($conn, $sql)) {
        header("location:../php/sub-categories.php?Warning= Sub-Category added Successfully");
    } else {
        header("location:../php/sub-categories.php?Warning= There is an error = " . mysqli_error($conn));
    }
} elseif (isset($_POST['product'])) {

    $category_name = $_POST['category_name'];
    $sub_category_name = $_POST['sub_category_name'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $unit_price = $_POST['unit_price'];
    $available_quantity = $_POST['available_quantity'];
    $created_at = $_POST['created_at'];
    $Price = $_POST['item_price'];

    $destination = "uploads/" . basename($_FILES['product_image']['name']);

    $sql = "INSERT INTO `product`(`category_name`, `sub_category_name`, `product_name`, `product_description`, `product_image`, `unit_price`, `available_quantity`, `created_at`)
            VALUES ('$category_name','$sub_category_name','$product_name','$product_description','$product_image','$unit_price','$available_quantity','$created_at')";

    if (mysqli_query($conn, $sql)) {
        move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
        header("location:../php/product-item.php?Warning= Product added Successfully");
    } else {
        header("location:../php/product-item.php?Warning= There is an error = " . mysqli_error($conn));
    }
} elseif (isset($_POST['update_items'])) {

    $update_id = $_POST['product_id'];

    $category_name = $_POST['category_name'];
    $sub_category_name = $_POST['sub_category_name'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    // $product_image = $_POST['product_image'];
    $unit_price = $_POST['unit_price'];
    $available_quantity = $_POST['available_quantity'];
    // $edited_at = $_POST['edited_at'];

    $sql = "UPDATE `product` SET `category_name`='$category_name',`sub_category_name`='$sub_category_name',`product_name`='$product_name',`product_description`='$product_description',
            `unit_price`='$unit_price',`available_quantity`='$available_quantity' WHERE product_id = '$update_id'";
    
    $update_query = mysqli_query($conn, $sql);
    if ($update_query) {
        header('location:../php/view-tables.php');
    } else {
        header('location:../php/view-tables.php?Warning= There is an error = ' . mysqli_error($conn));
    }

} elseif (isset($_POST['update_users'])) {

    $update_id = $_POST['user_id'];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];

    $sql = "UPDATE `users` SET `email`='$email',`password`='$password',`username`='$username',`role`='$role' WHERE user_id = '$update_id'";

    $update_query = mysqli_query($conn, $sql);
    if ($update_query) {
        header('location:../php/view-tables.php');
    } else {
        header('location:../php/view-tables.php?Warning= There is an error = ' . mysqli_error($conn));
    }
}
?>