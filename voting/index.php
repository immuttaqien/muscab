<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Musyawarah Cabang XIII PC. Pemuda Persis Banjaran</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

  <style>
    html, body {
      min-height: 100%;
    }
    body {
      font-family: Arial, sans-serif;
      position: relative;
      background-image: url('../static/img/background.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.90);
      z-index: 0;
      pointer-events: none;
    }
    .container {
      position: relative;
      z-index: 1;
    }
    .candidate-container {
      display: flex;
      overflow-x: auto;
      gap: 30px;
      padding: 10px;
      justify-content: center; 
      align-items: center;
    }
    .candidate-card {
      flex: 0 0 auto;
      width: 120px;
      text-align: center;
    }
    .candidate-card img {
      height: 80px;
      width: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 5px;
    }
    .chart {
      display: flex;
      justify-content: space-around;
      align-items: flex-end;
      height: 400px;
      border-top: 2px solid #ddd;
      margin-top: 20px;
/*      background-color: #f8f9fa;*/
      overflow-x: auto;
      padding-bottom: 20px;
    }
    .bar-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0 10px;
    }
    .bar {
      width: 60px;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      font-size: 15px;
      font-weight: bold;
      transition: height 0.5s ease;
    }
    .bar-container img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
      margin-top: 5px;
    }
    .info-container {
      display: flex;
      justify-content: space-between;
/*      padding: 15px 0 0;*/
/*      background-color: #f8f9fa;*/
    }
    .info-container div {
      flex: 1;
      text-align: center;
    }
    .info-container p {
      margin: 0px 0;
    }
    .info-container span {
      font-weight: bold;
    }

    .center{
        text-align: center
    }
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    /* IE 6 doesn't support max-height
    * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
        height: 200px;
    }
  </style>
</head>
<body>
  <div class="container mt-3">
    <div class="row mb-4" style="border-bottom: 2px solid #ddd;">
        <div class="col-md-6 mb-3" style="text-align: center;">
            <a href="index.php" class="logo"><img src="../static/img/logo.png" width="50%"></a>
        </div>
        <div class="col-md-6">
          <div class="p-3 rounded">
            <!-- <h4>Ringkasan Suara</h4> -->
            <div class="info-container">
              <div>
                <p><i class="bi bi-person-circle"></i> Jumlah Kandidat</p>
                <p id="totalCandidates" style="font-size: 3rem;">0</p>
              </div>
              <div>
                <p class="text-primary"><i class="bi bi-check2-circle"></i> Suara Masuk</p>
                <p id="totalVotes" style="font-size: 3rem;" class="text-primary">0</p>
              </div>
              <div>
                <p class="text-success"><i class="bi bi-check-circle"></i> Suara Sah</p> <p class="text-success" id="validVotes" style="font-size: 3rem;">0</p> <p class="text-success">(<span id="validVotesPercent">0</span>%)</p>
              </div>
              <div onclick="addInvalidVote()" style="cursor: pointer;">
                <p class="text-danger"><i class="bi bi-x-circle"></i> Suara Tidak Sah <p class="text-danger" id="invalidVotes" style="font-size: 3rem;">0</p> <p class="text-danger">(<span id="invalidVotesPercent">0</span>%)</p>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Kandidat -->
    <div class="mb-3" style="display: flex; gap: 20px; justify-content: center; align-items: center;">
      <h4 style="padding-top: 2px;">Kandidat</h4>
      <input style="width: 30%" type="text" id="candidateName" class="form-control" placeholder="Nama Kandidat">
      <input style="display: none" readonly type="text" id="candidateImage" class="form-control" placeholder="URL Foto Kandidat" value="../static/img/pemuda.png">
      <button onclick="addCandidate()" class="btn btn-primary">Tambah</button>
      <button onclick="resetVotes()" class="btn btn-danger">Reset</button>
      <!-- <button onclick="addInvalidVote()" class="btn btn-warning">+ Tidak Sah</button> -->
    </div>

    <div class="candidate-container" id="candidates"></div>

    <!-- Chart Voting -->
    <div class="chart container-fluid mt-3" id="barChart"></div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
  <script>
    let candidates = JSON.parse(localStorage.getItem("candidates")) || [];
    let invalidVotes = parseInt(localStorage.getItem("invalidVotes")) || 0;

    function saveData() {
      localStorage.setItem("candidates", JSON.stringify(candidates));
      localStorage.setItem("invalidVotes", invalidVotes);
    }

    function addCandidate() {
      const name = document.getElementById("candidateName").value;
      const image = document.getElementById("candidateImage").value;
      if (name && image) {
        candidates.push({ name, image, votes: 0 });
        saveData();
        renderCandidates();
        renderChart();
      }

      document.getElementById("candidateName").value = "";
    }

    function addInvalidVote() {
      invalidVotes++;
      saveData();
      renderCandidates();
      renderChart();
    }

    function vote(index, type) {
  if (type === "add") {
    candidates[index].votes++;
  }
  if (type === "subtract" && candidates[index].votes > 0) {
    candidates[index].votes--;
  }

  // Jika suara kandidat menjadi 0, hapus kandidat tersebut
  if (candidates[index].votes === 0) {
    candidates.splice(index, 1);  // Menghapus kandidat dari array
  }

  saveData();
  renderCandidates();
  renderChart();
}


    function resetVotes() {
      if (confirm("Apakah anda yakin akan mereset vote ini ?")) {
        candidates = [];
        invalidVotes = 0;
        saveData();
        renderCandidates();
        renderChart();
      }
    }

    function renderCandidates() {
      const container = document.getElementById("candidates");
      container.innerHTML = "";
      candidates.forEach((candidate, index) => {
        container.innerHTML += `
          <div class="candidate-card">
            <img src="${candidate.image}" alt="${candidate.name}">
            <div>${candidate.name}</div>
            <small>Suara: ${candidate.votes}</small>
            <div>
              <button onclick="vote(${index}, 'add')" class="btn btn-sm btn-success">+</button>
              <button onclick="vote(${index}, 'subtract')" class="btn btn-sm btn-danger">-</button>
            </div>
          </div>
        `;
      });
      document.getElementById("totalCandidates").innerText = candidates.length;
    }

    function renderChart() {
      const barChartDiv = document.getElementById("barChart");
      barChartDiv.innerHTML = "";
      const totalVotes = candidates.reduce((sum, c) => sum + c.votes, 0) + invalidVotes;
      const validVotes = candidates.reduce((sum, c) => sum + c.votes, 0);
      const validPercent = totalVotes > 0 ? ((validVotes / totalVotes) * 100).toFixed(2) : 0;
      const invalidPercent = totalVotes > 0 ? ((invalidVotes / totalVotes) * 100).toFixed(2) : 0;

      document.getElementById("totalVotes").innerText = totalVotes;
      document.getElementById("validVotes").innerText = validVotes;
      document.getElementById("validVotesPercent").innerText = validPercent;
      document.getElementById("invalidVotes").innerText = invalidVotes;
      document.getElementById("invalidVotesPercent").innerText = invalidPercent;

      candidates.forEach(candidate => {
        const barHeight = totalVotes > 0 ? (candidate.votes / totalVotes) * 280 : 0;
        const percentage = totalVotes > 0 ? ((candidate.votes / totalVotes) * 100).toFixed(2) : 0;

        barChartDiv.innerHTML += `
          <div class="bar-container">
            <div class="bar" style="height: ${barHeight}px;">${percentage}%</div>
            <img src="${candidate.image}" alt="${candidate.name}">
            <div>${candidate.name}</div>
          </div>
        `;
      });
    }

    renderCandidates();
    renderChart();
  </script>


<script>
$( function() {
    $( "#candidateName" ).autocomplete({
      minLength: 0,
      source: function (request, response) {
        $.ajax({
          url: "data_anggota.json",
          dataType: "json",
          cache: false,
          success: function (data) {
            const filtered = data.filter(item => {
              return item.nama_lengkap.toLowerCase().includes(request.term.toLowerCase());
            }).map(item => ({
              label: item.nama_lengkap,
              value: item.nama_lengkap,
              anggotaId: item.anggota_id,
              npa: item.npa,
              jamaah: item.jamaah
            }));
            response(filtered);
          },
          error: function () {
            console.error("Failed to fetch data from JSON file.");
            response([]);
          }
        });
      },
      focus: function( event, ui ) {
        $( "#candidateName" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#candidateName" ).val( ui.item.label );
        return false;
      }
    });
  } );
</script>
</body>
</html>
