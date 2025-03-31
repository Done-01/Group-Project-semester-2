<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MZMazwanBanking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background: linear-gradient(to right, #01bd01, black);">
            <div class="container-fluid">
              <a class="navbar-brand mb-0 h1" href="#">MZ</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="loginPage.php">Log in</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                  </li>
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
    </header>
    <main class="container bg-dark text-white my-5 rounded">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="images/Receptionist.jpeg" alt="" class="img-fluid" style="width: 80%; height: auto;">
                </div>
                <div class="col-md-6">
                    <h1 class= "mt-3">Welcome</h1>
                    <p class="mt-4">
                        Welcome to MZMazwan Bank, where your financial success is our priority. With a strong commitment to innovation, security, and customer service, we have been empowering individuals, businesses, and communities with reliable banking solutions for many years.
                    </p>
                    <h2 class="mb-3">What we offer:</h2>
                    <ul>
                        <li>Personal Banking: Savings and checking accounts, loans, credit cards, and digital banking solutions.</li>
                        <li>Business Banking: Tailored financial services, including business accounts, loans, and merchant solutions.</li>
                        <li>Investment & Wealth Management: Expert guidance on investments, retirement planning, and wealth management.</li>
                        <li>Digital Banking: Secure and seamless online and mobile banking services for convenient financial management.</li>
                    </ul>
                    <button type="button" class="btn btn-primary mt-2">About us</button>
                </div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <div class="p-3 mt-4 text-center" style="background: linear-gradient(to right, #03b803, black);">
                        We provide the best services to our customers.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card-group">
                        <div class="card">
                          <img src="images/Employees.jpg" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">Who We Are</h5>
                            <p class="card-text">At MZMazwan Bank, we believe in building lasting relationships with our customers by providing personalized financial solutions tailored to their unique needs. Our team of dedicated professionals works tirelessly to ensure that you have access to the best banking products and services available.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 days ago</small></p>
                            <button type="button" class="btn btn-primary">Read More</button>
                          </div>
                        </div>
                        <div class="card">
                          <img src="images/Money.jpg" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">Our Mission</h5>
                            <p class="card-text">Our mission is to provide safe, efficient, and customer-centric financial solutions that help our clients achieve their financial goals. We are dedicated to fostering economic growth, financial inclusion, and long-term prosperity for individuals and businesses alike.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 days ago</small></p>
                            <button type="button" class="btn btn-primary">Read More</button>
                          </div>
                        </div>
                        <div class="card">
                          <img src="images/Globe.jpg" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">Join Us Today</h5>
                            <p class="card-text">Experience banking that puts you first. Whether you're looking for personal, business, or investment banking solutions, MZMazwan Bank is here to help. Visit one of our branches, explore our online services, or contact our team to get started on your financial journey with confidence.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 days ago</small></p>
                            <button type="button" class="btn btn-primary">Read More</button>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row justify-content-center my-5">
                <form>
                    <div class="text-center">
                        <h2>Contact Us</h2>
                        <p class="lead">If you have any questions or inquiries, please fill out the form below:</p>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="exampleName1">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Subject</option>
                            <option value="1">Enquiry</option>
                            <option value="2">Technical</option>
                            <option value="3">Help</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check to agree to terms and conditions</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </main>
    <footer class="text-center text-lg-start bg-light text-muted mt-5">
        <div class="text-center p-4" style="background: linear-gradient(to right, #008000, lightgreen);">
          © 2025 MZMazwan Bank. All rights reserved.
        </div>
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>