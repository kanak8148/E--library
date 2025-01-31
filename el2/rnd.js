import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min";

function Navbar() {
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-info px-4 border-bottom">
      <div className="container-fluid">
        <a className="navbar-brand fs-2" href="#">
          Elibrary-<span className="text-danger">web</span>
        </a>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
          <ul className="navbar-nav ms-auto mb-2 mb-lg-0 fs-5">
            <li className="nav-item">
              <a className="nav-link active" aria-current="page" href="#">
                Home
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">
                About
              </a>
            </li>
            <li className="nav-item dropdown">
              <a
                className="nav-link dropdown-toggle"
                href="#"
                id="servicesDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Services
              </a>
              <ul className="dropdown-menu" aria-labelledby="servicesDropdown">
                <li>
                  <a className="dropdown-item" href="#">
                    Practice
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Courses
                  </a>
                </li>
                <li>
                  <hr className="dropdown-divider" />
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Research
                  </a>
                </li>
              </ul>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="login.html">
                Login
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">
                Important Links
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">
                Syllabus
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

function Footer() {
  return (
    <footer>
      <div className="bg-dark text-light text-center p-4">
        <div className="row">
          <div className="col-sm-3">
            <img src="logol.jpg" alt="Logo" style={{ width: "8rem" }} />
          </div>
          <div className="col-3 d-flex flex-column">
            <span>Tel-Phone</span>
            <span>Contact</span>
            <span>Email</span>
            <span>Address</span>
          </div>
          <div className="col-3 d-flex flex-column">
            <a className="text-light text-decoration-none" href="#">
              Home
            </a>
            <a className="text-light text-decoration-none" href="#">
              Courses
            </a>
            <a className="text-light text-decoration-none" href="#">
              Faculty
            </a>
            <a className="text-light text-decoration-none" href="#">
              Research
            </a>
          </div>
          <div className="col-3 d-flex flex-column">
            <a className="text-light text-decoration-none" href="#">
              Facebook
            </a>
            <a className="text-light text-decoration-none" href="#">
              Instagram
            </a>
            <a className="text-light text-decoration-none" href="#">
              Twitter
            </a>
            <a className="text-light text-decoration-none" href="#">
              LinkedIn
            </a>
          </div>
        </div>
      </div>
      <div className="bg-info text-center">
        <b>@2024 Policy Terms and Condition Copyright</b>
      </div>
    </footer>
  );
}

function App() {
  return (
    <div>
      <Navbar />
      <Footer />
    </div>
  );
}

export default App;
