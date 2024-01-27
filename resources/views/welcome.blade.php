<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/app.css')
    <title>Welcome to DormExtend</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .centered {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>


<body>
    
    <div class="container">
        <div class="jumbotron text-center" style="background-color: maroon; color: white;">
            <h1>Welcome to DormExtend</h1>
            <p class="lead">Manage your school's accommodations with ease.</p>
        </div>        
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                
                    <div class="card w-101 bg-base-100 shadow-xl">
                        <div class="card-body text-center">
                            <h2>DORMITORY</h2>
                            <p>Manage student dormitories efficiently.</p>
                        </div>
                        <a href="{{ route('login') }}" class="text-decoration-none">
                        <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    </div>
                </a>
            </div>
            
            
            <div class="col-md-6 text-center">
                <div class="card w-101 bg-base-100 shadow-xl">
                    <div class="card-body text-center">
                      <h2>HOSTEL</h2>
                      <p>Manage hostel accommodations for your students.</p>
                    </div>
                    <a href="{{ route('login') }}" class="text-decoration-none">
                    <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                  </div>
            </div>
        </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
