<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>quadraecom/pest-plugin-selectors test view</title>
</head>
<body>

<main>
    <ul>
        <li>List item 1 (999)</li>
        <li>List item 2 (999)</li>
        <li>List item 3 (999)</li>
        <li data-int="1234">List item 4 (999)</li>
        <li data-foo="bar">List item 5 (999)</li>
    </ul>

    <div class="single-string">
        <div class="item">a value</div>
    </div>

    <div class="single-int">
        <div class="item">1234</div>
    </div>

    <div class="multiple-same-string">
        <div class="item">same value</div>
        <div class="item">same value</div>
        <div class="item">same value</div>
    </div>

    <div class="multiple-different-string">
        <div class="item">same value</div>
        <div class="item">same value</div>
        <div class="item">different value</div>
    </div>

    <div class="int-value">1234</div>

    <div class="multiple-same-int">
        <div class="item">1234</div>
        <div class="item">1234</div>
        <div class="item">1234</div>
    </div>

    <div class="multiple-different-int">
        <div class="item">1234</div>
        <div class="item">1234</div>
        <div class="item">2345</div>
    </div>
</main>

<footer data-foo="bar"></footer>

</body>
</html>
