## asg
Web Developer - Assignment - Apeejay Sayta Group

##Steps to install and run this project in the linux-ubuntu.

1-clone the project in the root directory of server.
git clone https://github.com/Subhash106/asg.git

2- cd asg.

3- composer install

4- cp .env.example .env

5- php artisan key:generate

6- change following as per your development environment in the .env file.
DB_DATABASE=asg
DB_USERNAME=root
DB_PASSWORD=root

7- php artisan migrate:refresh --seed

8- php artisan passport:install

9- npm run dev

10- php artisan serve

11- enter http://127.0.0.1:8000 into browser url.

12- register and then login.

13- create personal access token by navigating to the "Personal Access Tokens" menu and copy & paste it into the headers of the ajax request located at "asg/resources/views/products/index.blade.php" 

			$.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                headers: {
                    "Authorization": "Bearer " + "PASTE_THE_ACCESS_TOKEN_HERE"
                },
                data: {
                    category: category,
                    name: name,
                    price: price
                },
                success: function(response, textStatus, xhr)
                {
                    window.location = "{{route('products.index')}}";
                },
                error: function(xhr, textStatus, errorThrown)
                {   
                    console.log(errorThrown);
                }
            }); 
