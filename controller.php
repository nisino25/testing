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

        // start login varificataion ------------------------
        // if the user exists ------------------------
        sql = "IF EXISTS (SELECT * FROM users WHERE email = '$email') BEGIN SELECT 1 END ELSE BEGIN SELECT 2 END";
        $result =mysqli_query($GLOBALS['connection'], $sql);
            
        if($result == 2){
            $validationList['email'] = 'メールアドレスかパスワードが違います';
            $validationFlag = false;
        }else{
            // if the password matches ------------------------
            sql = "SELECT * FROM users WHERE email = '$email'";
            $result =mysqli_query($GLOBALS['connection'], $sql);

            if($result !== $email){
                $validationList['email'] = 'メールアドレスかパスワードが違います';
                $validationFlag = false;
            }else{
                // procced login ------------------------  
                $_SESSION['isLoggedin'] = true
                $_SESSION['logedinEmail'] = $email
            }
            
            
        }

        

      
        
        



      }

      
    }else{
      // echo 'not yet';
    }
  }
