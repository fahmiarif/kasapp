<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $('#tahun').change(function() {
        window.location = '?q=' + $(this).val();
    })
</script>
<script>
    function print_iuran() {
        var divContents = document.getElementById("iuran_warga").innerHTML;
        var a = window.open('', '', '');
        a.document.write(`<html><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">`);
        a.document.write('<body > <h1>Data Iuran Warga <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        setTimeout(() => {
            a.print();
        }, 2000);
    }

    function print_pemasukan() {
        var divContents = document.getElementById("pemasukan").innerHTML;
        var a = window.open('', '', '');
        a.document.write(`<html><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">`);
        a.document.write('<body > <h1>Data Pemasukan & Pengeluaran <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        setTimeout(() => {
            a.print();
        }, 2000);
    }
</script>