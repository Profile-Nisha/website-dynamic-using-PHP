<?php
include_once './admin/connection.php';



$sql = "SELECT * FROM slider WHERE status = 1 ORDER BY sliderorder ASC;
";
$result = mysqli_query($conn, $sql);
$sliderImages = array();

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $sliderImages[] = $row['pic'];
  }
}

$sql = "SELECT * FROM heading";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $heading1 = $row['heading1'];
  $heading2 = $row['heading2'];
  $paragraph = $row['paragraph'];
} else {
  
  $collegeName = "MARWARI COLLEGE RANCHI";
  $collegeDescription = "NAAC Accredited Autonomous College with Potential For Excellence";
  $university = "Under Ranchi University";
}


?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>marwari-college-website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <section id="top">
    <div class="container fullwidth">

      <p id="date-time" class="pull-left">Monday, May 27, 2024&nbsp00:00:00 PM</p>
      <div style="float:right">
        <nav class="top-nav">
          <ul id="menu-top-menu">
            <li><a>Home</a>
              <span>|</span>
            </li>
            <li><a>NIRF</a>
              <span>|</span>
            </li>
            <li><a>NAAC</a>
              <span>|</span>
            </li>
            <li><a>visit intermediate section</a>
              <span>|</span>
            </li>
            <li><a>Scholarship</a>
              <span>|</span>
            </li>
            <li><a>RTI</a>
              <span>|</span>
            </li>
            <li><a>Discipline</a>
              <span>|</span>
            </li>
            <li><a>Co-curricular</a>
              <span>|</span>
            </li>
            <li><a>Gallery</a>
              <span>|</span>
            </li>
            <li><a>Tender</a>
              <span>|</span>
            </li>
            <li><a>Contact us</a>
              <span>|</span>
            </li>
            <li><a>Login webmail</a>
              <span>|</span>
            </li>
          </ul>
        </nav>

      </div>


  </section>

  <section class="bg_color">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3  col-12">
          <div class="logo_img text-center">
            <img src="assets/images/headerbg.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-9 col-12">
          <div class="logo_content">
            <!-- <h1>MARWARI COLLEGE RANCHI</h1>
            <h4>NAAC Accredited Autonomous College with Potential For Excellence</h4>
            <p>Under Ranchi University</p> -->
            <h1><?php echo $heading1; ?></h1>
            <h4><?php echo $heading2; ?></h4>
            <p><?php echo $paragraph; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="details">


    <div class="container-fluid">
      <div class="nav-link">
        <nav>
          <ul>
            <li>Home</li>
            <li>About-us</li>
            <li>Administration</li>
            <li>Departments</li>
            <li>Staff-Details</li>
            <li>Student-Portal</li>
            <li>IQAC</li>
            <li>NIRF</li>
            <li>Scholarship</li>

          </ul>
        </nav>
      </div>
    </div>

  </section>

  <section class="sectionfour">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-12">
          <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
              <?php foreach ($sliderImages as $index => $pic) : ?>
                <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                  <img src="./admin/<?php echo $pic; ?>" class="d-block w-100" alt="Slide <?php echo $index + 1; ?>">
                </div>
              <?php endforeach; ?>


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

        </div>
        <div class="col-lg-4 col-12">
          <div class="row">
            <div class="col-lg-6 col-12 p-0">
              <div class="facility">
                <img src="assets/images/st.png
              " alt="Placement Image" class="oval-image">
                <p>Placement</p>
              </div>
            </div>
            <div class="col-lg-6 col-12 p-0">
              <div class="facility">
                <img src="assets/images/py.png
              " alt="Placement Image" class="oval-image">
                <p>Pay Fee</p>
              </div>
            </div>
            <div class="col-lg-6 col-12 p-0">
              <div class="facility">
                <img src="assets/images/ad.png
              " alt="Placement Image" class="oval-image">
                <p>Admission</p>
              </div>
            </div>
            <div class="col-lg-6 col-12 p-0">
              <div class="facility">
                <img src="assets/images/el.png
               " alt="Placement Image" class="oval-image">
                <p>Examination</p>
              </div>
            </div>
            <div class="col-lg-6 col-12 p-0">
              <div class="facility">
                <img src="assets/images/ex.png
              " alt="Placement Image" class="oval-image">
                <p>Apply CLC </p>
              </div>
            </div>
            <div class="col-lg-6 col-12 p-0">
              <div class="facility">
                <img src="assets/images/teacher_login.png
              " alt="Placement Image" class="oval-image">
                <p>Results</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container-fluid mt-4">
      <div class="admission">
        <h3>Admission2024</h3>
      </div>
    </div>
  </section>
  <section>
    <div class="scroll-container mt-3">
      <div class="scroll-text"><img src="assets/images/new.gif" alt="Example GIF">
        Apply for online admission form through chancellor portal Bsc,B.com,BCA,MCA,IT,CND Last date 28-05-2024. </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>