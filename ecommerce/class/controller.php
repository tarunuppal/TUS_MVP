<?php
session_start();
require_once("model.php");
class Controller extends Model
{

    public $YES_NO = array("Y" => "Yes", "N" => "No");


    function Login($user, $pass, $url)
    {

        $query = "SELECT * FROM users where Username = '$user' AND Password = '$pass'";
        
        if ($data = $this->SingleSelect($query)) {
            $_SESSION['Admin'] = $data;
            header("Location:" . $url);
        } else {
            echo "<script> alert('Wrong usernname password');</script> ";
        }
    }

    function Logout()
    {
        unset($_SESSION['Admin']);
        header("Location:index.php");
    }


    function CleanData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function ReplaceSql($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    function Encrypt($data)
    {
        $cryptKey  = 'shoppingcat!@#$%^';
        $qEncoded      = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $data, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }

    function Decrypt($data)
    {
        $cryptKey  = 'shoppingcat!@#$%^';
        $qDecoded      = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return ($qDecoded);
    }

    

    function RequireLogin()
    {
        if (isset($_SESSION['Admin']) && $_SESSION['Admin'] != '') {
            return true;
        } else {
            Header("Location:" . ADMIN_URL );
        }
    }

    function UploadFile($FILES)
    {
        $errors = array();
        $file_name = $FILES['file']['name'];
        $file_size = $FILES['file']['size'];
        $file_tmp = $FILES['file']['tmp_name'];
        $file_type = $FILES['file']['type'];
        $file_ext = strtolower(end(explode('.', $FILES['file']['name'])));

        $expensions = array("jpeg", "jpg", "png");

        //      if(in_array($file_ext,$expensions)=== false){
        //         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        //      }

        if ($file_size > 20971520) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, UPLOADS_PATH . $file_name);
            return $file_name;
        } else {
            print_r($errors);
        }
    }

    function GetProducts($cat_id = "", $limit = "")
    {
        if ($cat_id) {
            $cat_id = " WHERE p.Category_Id ='" . $cat_id . "' ";
        }
        if ($limit) {
            $limit = " LIMIT " . $limit . " ";
        }
        $result = $this->Select("SELECT p.*,pc.* FROM product p LEFT JOIN product_category pc ON p.Category_Id = pc.Category_Id " . $cat_id . $limit);
        return $result;
    }

    function GetRandomProducts($limit)
    {
        $query = "SELECT p.*, pc.* FROM product p JOIN (SELECT CEIL(RAND() * (SELECT MAX(Product_Id) FROM product)) AS id) AS r2 LEFT OUTER JOIN product_category pc ON pc.Category_Id = p.Category_Id WHERE p.Product_Id >= r2.id ORDER BY p.Product_Id ASC LIMIT {$limit} ";
        //$query = "SELECT p.*, pc.* FROM product p LEFT JOIN product_category pc ON p.Category_Id = pc.Category_Id ORDER BY RAND(p.Product_Id) LIMIT {$limit}  ";
        return $this->Select($query);
    }

    function SingleProduct($id)
    {
        $data = $this->SingleSelect("SELECT p.*,pc.* FROM product p LEFT JOIN product_category pc ON p.Category_Id = pc.Category_Id WHERE p.Product_Id= '$id'");
        return $data;
    }

    function Search($product, $cat_id = "")
    {
        if ($cat_id) {
            $cat_id = " AND p.Category_Id ='" . $cat_id . "' ";
        }
        $result = $this->Select("SELECT p.*,pc.* FROM product p LEFT JOIN product_category pc ON p.Category_Id = pc.Category_Id where Product_Name LIKE '%" . $product . "%' " . $cat_id);
        return $result;
    }

    function UserRegister($POST)
    {
        $query = "INSERT INTO customers SET
                User_Email = '" . $POST['User_Email'] . "',
                User_First_Name='" . $POST['User_First_Name'] . "',
                User_Last_Name = '" . $POST['User_Last_Name'] . "',
                User_Password = '" . $POST['User_Password'] . "'";
        $result = $this->Insert($query);
        echo '<script>alert("Successfully Registered.");</script>';
        //        header("Location:".WEBSITE_URL);
        //        return $result;

    }

    function UserLogin($POST)
    {
        $User_Email = $this->CleanData($POST['User_Email']);
        $User_Password = $POST['User_Password'];
        $query = "SELECT * FROM customers where User_Email = '$User_Email' AND User_Password = '$User_Password'";
        $data = $this->SingleSelect($query);
        $count = $this->Count($query);
        if ($count == '1') {
            $_SESSION['Customer'] = TRUE;
            $_SESSION['Customer_Name'] = $data['User_First_Name'];
            $_SESSION['Customer_Id'] = $data['User_Id'];
            $_SESSION['C_Data'] = $data;
            echo '<script>alert("Login Success.");</script>';
            header("Location:" . WEBSITE_URL);
        } else {
            echo '<script>alert("Login Failed.");</script>';
            //            echo "Wrong usernname password";
        }
        //        print_r($data) ;
    }

    function UserLogout()
    {
        $_SESSION['Customer'] = FALSE;
        unset($_SESSION['Customer']);
        unset($_SESSION['Customer_Name']);
        unset($_SESSION['Customer_Id']);
        unset($_SESSION['C_Data']);
        header("Location:" . WEBSITE_URL);
    }

    function RequiredUserLogin(){
        if(!$_SESSION['Customer']){
            header("Location:" . WEBSITE_URL . 'login-register.php');
        }
    }

    function AddOrderItem($Customer_Id, $Product_Id, $Quantity)
    {
        $result = $this->Insert("Insert INTO order_item (Customer_Id,Product_Id,Quantity) VALUES ('$Customer_Id','$Product_Id','$Quantity')");
        return $result;
    }

    function MyCart($Customer_Id)
    {
        $result = $this->Select("SELECT product.*,product_category.Category_Name,order_item.Quantity, order_item.Id AS OI_Id FROM order_item
        LEFT JOIN product ON order_item.Product_Id = product.Product_Id
        LEFT JOIN customers ON order_item.Customer_Id = customers.User_Id
        LEFT JOIN product_category ON product.Category_Id = product_category.Category_Id
        WHERE order_item.Customer_Id = '$Customer_Id' AND order_item.Status = 'N'  ");
        return $result;
    }

    function DeleteCartItem($OrderItem_Id)
    {
        $this->Update("DELETE FROM order_item WHERE Id='" . $OrderItem_Id . "'  ");
    }

    function OrderHistory($Customer_Id)
    {
        $result = $this->Select("SELECT product.*,product_category.Category_Name,order_item.Quantity FROM order_item
        LEFT JOIN product ON order_item.Product_Id = product.Product_Id
        LEFT JOIN customers ON order_item.Customer_Id = customers.User_Id
        LEFT JOIN product_category ON product.Category_Id = product_category.Category_Id
        WHERE order_item.Customer_Id = '$Customer_Id' AND order_item.Status = 'Y'  ");
        return $result;
    }

    function CartCount($Customer_Id)
    {

        $result = $this->Count("SELECT product.*,product_category.Category_Name,order_item.Quantity FROM order_item
        LEFT JOIN product ON order_item.Product_Id = product.Product_Id
        LEFT JOIN customers ON order_item.Customer_Id = customers.User_Id
        LEFT JOIN product_category ON product.Category_Id = product_category.Category_Id
        WHERE order_item.Customer_Id = '$Customer_Id' AND order_item.Status = 'N'");

        return $result;
    }

    function getCategory()
    {

        $query = $this->Select("SELECT * FROM product_category WHERE Category_Publish = 'Y'");
        return $query;
    }
    function UpdateUserInfo($POST)
    {
        $this->Update("UPDATE customers SET
        User_City = '" . $POST['User_City'] . "',
        User_State = '" . $POST['User_State'] . "',
        User_Zip = '" . $POST['User_Zip'] . "',
        User_Address = '" . $POST['User_Address'] . "',
        User_Phone = '" . $POST['User_Phone'] . "'
        WHERE User_Id='" . $POST['Customer_Id'] . "' ");
    }

    function Checkout($POST)
    {
        $this->UpdateUserInfo($POST);
        $result = $this->Insert("INSERT INTO orders SET
				Order_Date = '" . date('Y-m-d H:i:s') . "',
        Order_Amount = '" . $POST['Order_Amount'] . "',
        Customer_Id = '" . $POST['Customer_Id'] . "'");
        $Customer_Id = $POST['Customer_Id'];
        $this->Update("Update order_item SET Status = 'Y', Order_Id = '$result' WHERE Customer_Id = '$Customer_Id' AND Order_Id = '0' ");
        header("Location:finish.php");
    }



    //    name,email,subject,msg


    function FeedBack($POST)
    {
        $this->Insert("INSERT INTO feedback SET
        Customer_Name ='" . $POST['Username'] . "',
        Customer_Email ='" . $POST['Email'] . "',
        Subject ='" . $POST['Subject'] . "',
        Message ='" . $POST['Username'] . "'");
    }

    function GetCustomerDetail($Customer_Id)
    {

        $result = $this->SingleSelect("Select * FROM customers WHERE User_Id ='$Customer_Id' ");
        return $result;
    }
    function GetInvoiceItems()
    {
        $result = $this->Select("SELECT product.*,product_category.Category_Name,order_item.Quantity,customers.User_First_Name FROM order_item
		LEFT JOIN product ON order_item.Product_Id = product.Product_Id
		LEFT JOIN customers ON order_item.Customer_Id = customers.User_Id
		LEFT JOIN product_category ON product.Category_Id = product_category.Category_Id
		WHERE order_item.Status = 'Y'  ");
        return $result;
    }

    function GetInvoices()
    {
        $result = $this->Select("Select orders.*,customers.User_First_Name From orders LEFT JOIN customers ON orders.Customer_Id= customers.User_Id");
        return $result;
    }

    function PerInvoiceOrders($Order_Id)
    {
        $result = $this->Select("SELECT product.*,product_category.Category_Name, customers.*, order_item.Order_Id, order_item.Quantity FROM order_item
		INNER JOIN product ON order_item.Product_Id = product.Product_Id
		INNER JOIN customers ON order_item.Customer_Id = customers.User_Id
		INNER JOIN product_category ON product.Category_Id = product_category.Category_Id
		WHERE order_item.Status = 'Y' AND Order_Id = '$Order_Id' ");
        return $result;
    }

    function UpdateUserProfile($POST){
        $q = "UPDATE customers SET
        User_Email = '" . $POST['User_Email'] . "',
        User_Password = '" . $POST['User_Password'] . "',
        User_First_Name = '" . $POST['User_First_Name'] . "',
        User_Last_Name = '" . $POST['User_Last_Name'] . "',
        User_City = '" . $POST['User_City'] . "',
        User_State = '" . $POST['User_State'] . "',
        User_Zip = '" . $POST['User_Zip'] . "',
        User_Address = '" . $POST['User_Address'] . "',
        User_Phone = '" . $POST['User_Phone'] . "'
        WHERE User_Id='" . $_SESSION['C_Data']['User_Id'] . "' ";
        $this->Update($q);
        
        $data = $this->SingleSelect("SELECT * FROM customers WHERE User_Id='" . $_SESSION['C_Data']['User_Id'] . "' ");
        $_SESSION['Customer_Name'] = $data['User_First_Name'];
        $_SESSION['C_Data'] = $data;

        echo '<script>alert("Profile Updated");</script>';
    }

}
