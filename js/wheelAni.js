document.addEventListener("scroll", () => {
  for (let p of document.querySelectorAll(".scroHidden")) {
    if (p.getBoundingClientRect().top - window.innerHeight + 50 <= 0) {
      p.classList.add("scroVisible");
    } else {
      p.classList.remove("scroVisible");
    }
  }

  for (let p of document.querySelectorAll(".blurImg")) {
    if (p.getBoundingClientRect().top - window.innerHeight + 150 <= 0) {
      p.classList.remove("scroBlur");
    } else p.classList.add("scroBlur");
  }
});
