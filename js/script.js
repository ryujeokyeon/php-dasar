// ambil element yang dibutuhkan
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// event
// tombolCari.addEventListener("click", function () {
//   alert("BERHASIL!");
// });

// tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function() {
  // console.log(keyword.value);
  // buat object AJAX
  var xhr = new XMLHttpRequest();

  // cek kesiapan AJAX
  xhr.onreadystatechange = function () {
    // 4 ready, 200 okay/o
    if ( xhr.readyState == 4 && xhr.status == 200 ) {
      //   console.log(xhr.responseText);
      container.innerHTML = xhr.responseText;
    }
  }

  // eksekusi AJAX
  xhr.open('GET', 'ajax/chara.php?keyword=' + keyword.value, true);
  xhr.send();


});
