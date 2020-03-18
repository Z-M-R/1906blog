<?php
    $user = 'root';
    $pass = '123456abc';
    $dbh = new PDO('mysql:host=localhost;dbname=1906blog', $user, $pass);

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);

    if($username == "" || $password == "" || $password2 == "") { 
        echo "<script>alert('请确认信息完整性'); history.go(-1);</script>"; 
    }else{
        if ($password == $password2) {
           
            $stmt = $dbh->prepare("insert into users (`username`,`password`) values (?,?)");
            // 绑定参数
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $password);
            // 执行sql
            $stmt->execute();

            $id = $dbh->lastInsertId();
            if($id){
                echo "<script>alert('注册成功'); location='login.html'</script>"; 
            }else{
                echo "<script>alert('注册失败'); history.go(-1);</script>"; 
            }
        }else{
            echo "<script>alert('密码不一致'); history.go(-1);</script>"; 
        }
    } 
    

    
?>