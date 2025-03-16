<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UD Toko Diva Mowewe</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <script data-cfasync="false"
        nonce="484dc87f-8b3b-4f2e-9be2-19e98a69c0ca">try {(function (w, d) {!function (j, k, l, m) {if (j.zaraz) console.error("zaraz is loaded twice"); else {j[l] = j[l] || {}; j[l].executed = []; j.zaraz = {deferred: [], listeners: []}; j.zaraz._v = "5850"; j.zaraz._n = "484dc87f-8b3b-4f2e-9be2-19e98a69c0ca"; j.zaraz.q = []; j.zaraz._f = function (n) {return async function () {var o = Array.prototype.slice.call(arguments); j.zaraz.q.push({m: n, a: o})}}; for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p); j.zaraz.init = () => {var q = k.getElementsByTagName(m)[0], r = k.createElement(m), s = k.getElementsByTagName("title")[0]; s && (j[l].t = k.getElementsByTagName("title")[0].text); j[l].x = Math.random(); j[l].w = j.screen.width; j[l].h = j.screen.height; j[l].j = j.innerHeight; j[l].e = j.innerWidth; j[l].l = j.location.href; j[l].r = k.referrer; j[l].k = j.screen.colorDepth; j[l].n = k.characterSet; j[l].o = (new Date).getTimezoneOffset(); if (j.dataLayer) for (const t of Object.entries(Object.entries(dataLayer).reduce(((u, v) => ({...u[1], ...v[1]})), {}))) zaraz.set(t[0], t[1], {scope: "page"}); j[l].q = []; for (; j.zaraz.q.length;) {const w = j.zaraz.q.shift(); j[l].q.push(w)} r.defer = !0; for (const x of [localStorage, sessionStorage]) Object.keys(x || {}).filter((z => z.startsWith("_zaraz_"))).forEach((y => {try {j[l]["z_" + y.slice(7)] = JSON.parse(x.getItem(y))} catch {j[l]["z_" + y.slice(7)] = x.getItem(y)} })); r.referrerPolicy = "origin"; r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l]))); q.parentNode.insertBefore(r, q)};["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init)} }(w, d, "zarazData", "script"); window.zaraz._p = async bs => new Promise((bt => {if (bs) {bs.e && bs.e.forEach((bu => {try {const bv = d.querySelector("script[nonce]"), bw = bv?.nonce || bv?.getAttribute("nonce"), bx = d.createElement("script"); bw && (bx.nonce = bw); bx.innerHTML = bu; bx.onload = () => {d.head.removeChild(bx)}; d.head.appendChild(bx)} catch (by) {console.error(`Error executing script: ${bu}\n`, by)} })); Promise.allSettled((bs.f || []).map((bz => fetch(bz[0], bz[1]))))} bt()})); zaraz._p({"e": ["(function(w,d){})(window,document)"]});})(window, document)} catch (e) {throw fetch("/cdn-cgi/zaraz/t"), e;};</script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p>
                <b>UD Toko Diva Mowewe</b>
            </p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"></p>

                <form action="{{ url('/login') }}" method="POST">
                @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>
</body>

</html>
