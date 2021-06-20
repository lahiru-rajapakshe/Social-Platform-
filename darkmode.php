<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>

  <style>
    :root{
  --bs-dark: #212529;
}

.theme-container {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: 0.5s;
}

.theme-container:hover {
  opacity: 0.8;
}

.shadow-dark {
  background: linear-gradient(145deg, #23282c, #1e2125);
  box-shadow: 17px 17px 23px #1a1d20,
    -17px -17px 23px #282d32, inset 5px 5px 4px #1e2226,
    inset -5px -5px 4px #24282c;
}

.shadow-light {
  box-shadow: 7px 7px 15px -10px #bbcfda, -4px -4px 13px #ffffff,
    inset 7px 7px 3px rgba(209, 217, 230, 0.35),
    inset -11px -11px 3px rgba(255, 255, 255, 0.3)
}

@keyframes change {
  0% {
    transform: scale(1);
  }

  100% {
    transform: scale(1.4);
  }
}

.change {
  animation-name: change;
  animation-duration: 1s;
  animation-direction: alternate;
}
  </style>
</head>
<body>

  <div class="theme-container shadow-dark">
  <img id="theme-icon"    src="http://upir.ir/images/naf6siuc4jn3eqjb9380.svg" alt="ERR">
</div>


<script>
  document.body.style="background-color: var(--bs-dark);transition: 0.5s;"
const sun = "http://upir.ir/images/3h5bm7om60h8p238b15.svg";
const moon = "http://upir.ir/images/naf6siuc4jn3eqjb9380.svg"

var theme = "dark";
  const root = document.querySelector(":root");
  const container = document.getElementsByClassName("theme-container")[0];
  const themeIcon = document.getElementById("theme-icon");
  container.addEventListener("click", setTheme);
  function setTheme() {
    switch (theme) {
      case "dark":
        setLight();
        theme = "light";
        break;
      case "light":
        setDark();
        theme = "dark";
        break;
    }
  }
  function setLight() {
    root.style.setProperty(
      "--bs-dark",
      "linear-gradient(318.32deg, #c3d1e4 0%, #dde7f3 55%, #d4e0ed 100%)"
    );
    container.classList.remove("shadow-dark");
    setTimeout(() => {
      container.classList.add("shadow-light");
      themeIcon.classList.remove("change");
    }, 300);
    themeIcon.classList.add("change");
    themeIcon.src = sun;
  }
  function setDark() {
    root.style.setProperty("--bs-dark", "#212529");
    container.classList.remove("shadow-light");
    setTimeout(() => {
      container.classList.add("shadow-dark");
      themeIcon.classList.remove("change");
    }, 300);
    themeIcon.classList.add("change");
    themeIcon.src = moon;
  }
</script>
</body>
</html>