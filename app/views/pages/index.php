<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>

<!--receive data array and display-->
<h1 class="display-3"> <?php echo $data['title']; ?> </h1>

<div id="page-content">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h1 class="font-weight-light mt-4 text-white">Sticky Footer using Flexbox</h1>
                <p class="lead text-white-50">Use just two Bootstrap 4 utility classes and three custom CSS rules and you will have a flexbox enabled sticky footer for your website!</p>
            </div>
        </div>
    </div>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>