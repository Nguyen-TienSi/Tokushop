const list_imgs = Array.from(document.querySelectorAll("#img-collection img"));
const img_collection = document.getElementById("img-collection");

let currentImg = 0;
let selectedImg = null;

function elem(currentImg) {
  img_collection.innerHTML = "";

  for (let i = currentImg; i < currentImg + 3; i++) {
    const img_item = document.createElement("div");
    img_item.classList.add("img-item");
    const img = document.createElement("img");
    img.src = list_imgs[i].src;
    img_item.appendChild(img);
    img_collection.appendChild(img_item);

    img.addEventListener("click", () => {
      const main_img = document.querySelector("#main-img img");

      if (selectedImg) {
        selectedImg.parentElement.classList.remove("selected");
      }

      img.parentElement.classList.add("selected");
      selectedImg = img;

      main_img.src = img.src;
    });
  }
}

function prevImg() {
  if (currentImg > 0) {
    currentImg--;
    elem(currentImg);
  }
}

function nextImg() {
  if (currentImg < list_imgs.length - 3) {
    currentImg++;
    elem(currentImg);
  }
}

elem(0);

