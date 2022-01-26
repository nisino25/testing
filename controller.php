public function login(){
    
    if(isset($_POST['submit'])){
      // echo 'sent it ';
      $validationFlag = true;
      $validationList = [
          "email"=> true,
          "password"=> true,
      ];
      
      
      
      
      $email= $_POST['email']; 
      $password = $_POST['password'];

      if(!$email){
        $validationList['email'] = 'メールは必須入力です';
        $validationFlag = false;
        
      }if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationList['email'] = 'メールアドレスは正しくご入力ください。';
        $validationFlag = false;
      }

      if(!$password){
        $validationList['password'] = 'パスワードは必須入力です';
        $validationFlag = false;
      }


      
     $_SESSION['validationList'] = $validationList ;
      $_SESSION['validationFlag'] = $validationFlag ;
    // -------------------------------------------------------------

      if(!$validationFlag){
        return;
        echo 'failed';
      }else{

        

      
        
        $email = mysqli_real_escape_string($GLOBALS['connection'],$email );
        $password = mysqli_real_escape_string($GLOBALS['connection'],$password );
        
        
        $sql = "INSERT INTO users(id, country_id, email, password, role) VALUES (NULL, 0, '$email', '$password', 0)";

        $result =mysqli_query($GLOBALS['connection'], $sql);

        // $this->updateaTable();


        

        // INSERT INTO new_table (Foo, Bar, Fizz, Buzz) SELECT Foo, Bar, Fizz, Buzz FROM initial_table
    
        if(!$result){
          die('failed sending data. <br>'. mysqli_error($GLOBALS['connection']));
          
        }else{
          header("Location: ./index.php");
          die();
        }



      }

      
    }else{
      // echo 'not yet';
    }
  }
