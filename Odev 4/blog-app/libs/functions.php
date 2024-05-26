<?php

function getData(){
    $myfile = fopen("db.json","r");
    $size = filesize("db.json");

    $result = json_decode(fread($myfile, $size), true);
    fclose($myfile);

    return $result;
}
 function createUser(string $name,string $username,string $email,string $password){
    $db = getData();

    array_push($db["users"], array(
        "id" => count($db["users"]) + 1,
        "username" => $username,
        "password" => $password,
        "name" => $name,
        "email" => $email
    ));

    $myfile = fopen("db.json","w");
    fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    fclose($myfile);


 }

 function getActiveMovies() {
    $db = getData();
    foreach($db["movies"] as $movie) {
        // varsa ve true ise
        if(isset($movie["is-active"]) && $movie["is-active"]) {
            $result[] = $movie;
        }
    }

    return $result;
 }

function getUser(string $username){
    $users = getData()["users"];

    foreach($users as $user){
        if($user["username"] == $username){
            return $user;
        }
    }
    return null;
}

function getBlogs(){
    include "settings.php";

    $query = "SELECT * FROM blogs";
    $result =  mysqli_query($connection, $query);

    mysqli_close($connection);
    
    return $result;
}

function createBlog(string $title, string $description, string $image,string $url,int $isActive = 0) {
    // $db = getData();

    // array_push($db["movies"], array(
    //     "id" => count($db["movies"]) + 1,
    //     "title" => $title,
    //     "description" => $description,
    //     "image" => $image,
    //     "url" => $url,
    //     "comments" => $comments,
    //     "likes" => $likes,
    //     "is-active" => false
    // ));

    // $myfile = fopen("db.json","w");
    // fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    // fclose($myfile);
    include "settings.php";

    // $query = "INSERT INTO blogs(title,description,image,url,isActive) VALUES ('$title','$description', '$image','$url', 1)";
    // Prepared sorgu
    $query = "INSERT INTO blogs(title,description,image,url,isActive) VALUES (?,?,?,?,?)";
    $result = mysqli_prepare($connection,$query);
    mysqli_stmt_bind_param($result, 'ssssi', $title, $description, $image, $url, $isActive); // parametre türü si string i integer
    // integer sayısı kadar i, string sayısı kadar s
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);
    // $result = mysqli_query($connection, $query);
//    mysqli_close($connection);

    return $result;
}

function editBlog(int $id,string $title,string $description,string $image,string $url, int $isActive){
    // $db = getData();

    // foreach($db["movies"] as &$movie){
    //     if($movie["id"] == $id){
    //         $movie["title"] = $title;
    //         $movie["description"] = $description;
    //         $movie["image"] = $image;
    //         $movie["url"] = $url;
    //         $movie["is-active"] = $isActive;

    //         $myfile = fopen("db.json","w");
    //         fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    //         fclose($myfile);

    //         break;
    //     }
    // }
    include "settings.php";

    $query = "UPDATE blogs SET title='$title', description='$description', image='$image', url= '$url', isActive='$isActive' WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    // echo mysqli_error();
    return $result;
    mysqli_close($connection);

}

function deleteBlog(int $id){
    // $db = getData();

    // foreach($db["movies"] as $key => $movie){
    //     if($movie['id'] === $id){
    //         array_splice($db["movies"],$key,1);
    //         break;
    //     }
    // }
    // $myfile = fopen("db.json","w");
    // fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    // fclose($myfile);

    include "settings.php";
    $query = "DELETE from blogs WHERE id=$id";// integer olduğu '' gerek yok
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    // delete işleminden sonra mesaj döndür silindi gibi
    return $result;

}

function getBlogByID(int $id){
    // $movies = getData()["movies"];

    // foreach($movies as $movie){
    //     if($movie["id"] == $id){
    //         return $movie;
    //     }
    // }

    // return null;
    include "settings.php";

    $query = "SELECT * FROM blogs WHERE id=$id"; 
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function kisaAciklama($aciklama, $limit) {
    if (strlen($aciklama) > $limit) {
        echo substr($aciklama,0,$limit)."...";
    } else {
        echo $aciklama;
    };
}

function control_input($data) {
    $data = htmlspecialchars($data); // html ile alakalı güvenlik amaçlı özel karakterleri dönüştürüyor
    $data = stripslashes($data); // sql ile alakalı injection?? güvenlik amaçlı yan çizgileri kaldırıyor
    return $data;
}

?>