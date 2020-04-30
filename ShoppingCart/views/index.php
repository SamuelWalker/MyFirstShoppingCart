  <?php require 'inc/header.php';?>
  <body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">About</h4>
            <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contact</h4>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Follow on Twitter</a></li>
              <li><a href="#" class="text-white">Like on Facebook</a></li>
              <li><a href="#" class="text-white">Email me</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
          <strong>Album</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div> -->
  </header>

  <main role="main">
   <!--  <section class="jumbotron text-center">
      <div class="container">
        <h1>Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="product.html" class="btn btn-primary my-2">product</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </section> -->

    <div class="album py-5 bg-light">
      <div class="container">
        
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-6 shadow-sm">
            	<a href="#">
            		<img src="img/Altis.png" class="img-fluid" alt="Altis">
              	<div class="card-body">
	               	<h5 class="card-title">ALTIS</h5>
	                <div class="d-flex justify-content-between align-items-center">
	                	<small class="text-muted">NT$69.8~77.8萬</small>
	                </div>            	           	
              	</div>
              </a> 
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-6 shadow-sm">
            	<a href="#">
            		<img src="img/Prius.png" class="img-fluid" alt="Prius">
              	<div class="card-body">
               	 <h5 class="card-title">PRIUS</h5>
                <div class="d-flex justify-content-between align-items-center">
                	<small class="text-muted">NT$112.9~112.9萬</small>
                </div>            	           	
              	</div>
              </a> 
            </div>
          </div>           
        </div>
        <?php foreach($data['products'] as $product):;?>
          <?php if($data['count']%3 == 0):;?>
            <div class="row">
          <?php endif;?>
              <div class="col-md-4">
          <!--  -->
                <div class="card card-body mb-3">
                  <a href="product.php?productId=<?php echo $product->id; ?>">
                    <img src="img/<?php echo $product->productImg; ?>" alt="<?php echo explode('.',$product->productImg)[0]; ?>" style="width: 220px;">
                  <h4 class="card-title"><?php echo $product->productName;?></h4>
                  <div class="bg-light p-2 mb-3 pricetag"><?php echo $product->productPrice; ?></div>
                  <p class="card-text"><?php echo $product->description;?></p>
                  </a>
                </div>         
              </div>
          <?php if($data['count'] % 3 == 2 || $data['count'] == $data['rows']-1):;?>
            </div>
          <?php endif;
            $data['count']++;
          ?>
        <?php endforeach;?>        
      </div>
    </div>
    </main>
  <?php require 'inc/footer.php'?>
  