<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

    <style>
.bg-hero {
    background: url("assets/img/WISATA-BALI.jpg") no-repeat;
    background-size: cover;
}

.card {
    display: flex;
    flex-direction: column;
    height: 100%;
    border: 1px solid #ddd;
    border-radius: 0.25rem;
}

.card img {
    width: 100%;
    height: 200px; /* Sesuaikan dengan tinggi yang diinginkan */
    object-fit: cover;
}

.card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-title {
    margin-bottom: 0.5rem;
}

.card-text {
    margin-bottom: 1rem;
}

.btn-primary {
    margin-top: auto; /* Menjaga tombol tetap di bagian bawah card */
}
</style>

<body>
</body>
</head>


<div class="container my-4 p-5 bg-hero rounded">
        <div class="py-5 text-white">
            <p class="display-5 fw-bold">WELCOME !!</p>
        <p class="fs-4 col-md-8">Capture every precious moment and share it with the world. Our platform is designed to highlight beauty through the lens of photography,
             creating a space for you to explore and appreciate visually stunning works.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php 
            $tampil = mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.userid = user.userid");
            foreach ($tampil as $tampils):
            ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <img src="uploads/<?= htmlspecialchars($tampils['namafile']) ?>" alt="<?= htmlspecialchars($tampils['judulfoto']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($tampils['judulfoto']) ?></h5>
                        <p class="card-text text-muted">by: <?= htmlspecialchars($tampils['username']) ?></p>
                        <a href="?url=detail&&id=<?= $tampils['fotoid'] ?>" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>  
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>