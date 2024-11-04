<!doctype html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous" />
    <title>Document</title>
  </head>
  <body class="vh-100">
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">미니보드</a>
        </div>
      </nav>
    </header>

    <main class="d-flex justify-content-center align-items-center h-75">
      <form style="width: 300px" action="./login.php">
        <div id="errMsg" class="form-text text-danger">에러에러에러</div>
        <div class="mb-3">
          <label for="id" class="form-label">아이디</label>
          <input type="email" name="id" class="form-control" id="id" />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">비밀번호</label>
          <input type="password" name="password" class="form-control" id="password" />
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">이름</label>
          <input type="text" name="name" class="form-control" id="name" />
        </div>
        <button type="submit" class="btn btn-dark w-100 mb-3">가입</button>
        <a href="./login.php" class="btn btn-secondary w-100">취소</a>
      </form>
    </main>

    <!-- footer -->
    <footer class="fixed-bottom bg-dark text-light text-center p-3">저작권</footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>
</html>
