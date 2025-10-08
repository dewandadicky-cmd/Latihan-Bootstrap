<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Money Heist - La Casa de Papel</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Latihan Bootstrap_20232014.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-danger d-flex align-items-center" href="#home">
      <img src="img/LOGO MONEY HEIST.jpg" alt="Logo Money Heist" width="45" height="45" class="me-2 rounded-circle">
      Money Heist
    </a>

    <!-- Tombol Toggle Muncul di HP -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Navigasi -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#characters">Characters</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1>La Casa de Papel</h1>
    <p>"The Perfect Heist Begins with a Plan"</p>
    <a href="#characters" class="btn btn-danger btn-lg">Meet the Team</a>
  </div>
</section>


<!-- About Section -->
<section id="about" class="py-5 text-white parallax-about">
  <div class="container">
    <h2 class="text-center mb-4">About The Series</h2>
    <?php
    include 'db_connect.php';
    $result = $conn->query("SELECT paragraph FROM about_series WHERE id=1");
    $row = $result->fetch_assoc();
    ?>
    <p class="text-center mb-5">
      <strong>Money Heist (La Casa de Papel)</strong> 
      <?php echo $row['paragraph']; ?>
    </p>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="p-3 border rounded h-100">
          <h5>Season 1</h5>
          <p>The Professor merekrut 8 orang untuk merampok Royal Mint of Spain. Mereka menyandera dan mencetak uang selama 11 hari.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-3 border rounded h-100">
          <h5>Season 2</h5>
          <p>Melanjutkan perampokan Royal Mint. Hubungan emosional, pengkhianatan, dan pengorbanan muncul saat mereka berusaha keluar.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-3 border rounded h-100">
          <h5>Season 3</h5>
          <p>Para anggota berkumpul kembali untuk menyelamatkan Rio yang ditangkap polisi. Target baru: Bank of Spain.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-3 border rounded h-100">
          <h5>Season 4</h5>
          <p>Kekacauan terjadi di dalam bank. Kehilangan besar mengguncang tim, tetapi rencana harus terus berjalan.</p>
        </div>
      </div>
      <div class="col-12">
        <div class="p-3 border rounded h-100">
          <h5>Season 5</h5>
          <p>Final showdown. Perang besar dengan militer, pengorbanan terbesar, dan akhir dari kisah epik perampokan.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Ratings Section (Realtime ChartJS) -->
<section id="ratings" class="py-5 bg-dark text-white">
  <div class="container">
    <h2 class="text-center mb-4">Season Ratings (Realtime)</h2>
    <canvas id="ratingChart" width="400" height="200"></canvas>
  </div>
</section>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('ratingChart');
let ratingChart;

// Fungsi ambil data dari get_ratings.php
async function fetchRatings() {
  const response = await fetch('get_ratings.php');
  const data = await response.json();

  const labels = data.map(item => item.season);
  const ratings = data.map(item => parseFloat(item.rating));

  return { labels, ratings };
}

// Inisialisasi Chart
async function initChart() {
  const { labels, ratings } = await fetchRatings();

  ratingChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Season Ratings',
        data: ratings,
        borderWidth: 1,
        backgroundColor: 'rgba(255, 59, 59, 0.7)',
        borderColor: '#ff3b3b'
      }]
    },
    options: {
      scales: {
        y: { beginAtZero: true, max: 10 }
      }
    }
  });
}

// Update chart tiap 5 detik
async function updateChart() {
  const { labels, ratings } = await fetchRatings();
  ratingChart.data.labels = labels;
  ratingChart.data.datasets[0].data = ratings;
  ratingChart.update();
}

initChart();
setInterval(updateChart, 5000);
</script>


<!-- Characters Section -->
<section id="characters" class="py-5 bg-dark text-white">
  <div class="container">
    <h2 class="text-center mb-4">Main Characters - First Heist</h2>
    <div class="row g-4">

      <!-- The Professor -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/The Professor Money Heist.jpg" alt="The Professor">
          <div class="overlay">
            <h5>The Professor</h5>
            <p>Mastermind of the heist, operating from outside.</p>
          </div>
        </div>
      </div>

      <!-- Berlin -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Berlin Money Heist.jpg" alt="Berlin">
          <div class="overlay">
            <h5>Berlin</h5>
            <p>The leader inside the Mint, strict and strategic.</p>
          </div>
        </div>
      </div>

      <!-- Tokyo -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Tokyo Money Heist.jpg" alt="Tokyo">
          <div class="overlay">
            <h5>Tokyo</h5>
            <p>Reckless but brave, also the narrator of the story.</p>
          </div>
        </div>
      </div>

      <!-- Rio -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Rio Money Heist.jpg" alt="Rio">
          <div class="overlay">
            <h5>Rio</h5>
            <p>Young hacker, Tokyo’s lover, IT specialist.</p>
          </div>
        </div>
      </div>

      <!-- Nairobi -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Nairobi.jpg" alt="Nairobi">
          <div class="overlay">
            <h5>Nairobi</h5>
            <p>In charge of money printing and quality control.</p>
          </div>
        </div>
      </div>

      <!-- Moscow -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Moscow Money Heist.jpg" alt="Moscow">
          <div class="overlay">
            <h5>Moscow</h5>
            <p>Denver’s father, tunnel drilling expert.</p>
          </div>
        </div>
      </div>

      <!-- Denver -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Denver Money Heist.jpg" alt="Denver">
          <div class="overlay">
            <h5>Denver</h5>
            <p>Moscow’s son, famous for his unique laugh.</p>
          </div>
        </div>
      </div>

      <!-- Helsinki -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Helsinki Money Heist.jpg" alt="Helsinki">
          <div class="overlay">
            <h5>Helsinki</h5>
            <p>Serbian soldier, strong and loyal.</p>
          </div>
        </div>
      </div>

      <!-- Oslo -->
      <div class="col-md-4">
        <div class="character-card">
          <img src="img/Oslo Money Heist.jpg" alt="Oslo">
          <div class="overlay">
            <h5>Oslo</h5>
            <p>Helsinki’s brother, quiet but powerful presence.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Contact Section -->
<section id="contact" class="py-5 parallax-contact text-white">
  <div class="container text-center">
    <h2>Contact Us</h2>
    <form class="contact-form mx-auto" action="save_message.php" method="POST">
      <div class="row mb-3">
        <div class="col-md-6 mb-2 mb-md-0">
          <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="col-md-6">
          <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>
      </div>
      <div class="mb-3">
        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
      </div>
      <button type="submit" class="btn btn-danger w-100">Kirim</button>
    </form>
  </div>
</section>


<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">© 2025 Money Heist Fan Page</p>
</footer>

<script>
const navLinks = document.querySelectorAll('.navbar .nav-link');
const sections = document.querySelectorAll('section');

function activateMenu() {
  let currentSection = '';

  sections.forEach(section => {
    const sectionTop = section.offsetTop - 150;
    const sectionHeight = section.offsetHeight;
    const scrollY = window.scrollY;

    // Tentukan section aktif berdasarkan posisi scroll
    if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
      currentSection = section.id;
    }
  });

  // Gabungkan "ratings" ke "about"
  if (currentSection === 'ratings') currentSection = 'about';

  // Jika sudah di paling bawah → aktifkan "contact"
  if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 5) {
    currentSection = 'contact';
  }

  // Update active class pada navbar
  navLinks.forEach(link => {
    link.classList.remove('active');
    const href = link.getAttribute('href').replace('#', '');
    if (href === currentSection) {
      link.classList.add('active');
    }
  });
}

window.addEventListener('scroll', activateMenu);
window.addEventListener('load', activateMenu);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
