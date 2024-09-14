const list_items = Array.from(document.querySelectorAll(".product"));
const list_element = document.getElementById("product-list");
const pagination_element = document.getElementById("pagination");

let current_page = 1;
const rows = 6;

const DisplayList = (items, wrapper, rows_per_page, page) => {
  wrapper.innerHTML = "";
  page--;
  const start = rows_per_page * page;
  const end = start + rows_per_page;
  const paginatedItems = items.slice(start, end);

  for (const item of paginatedItems) {
    wrapper.appendChild(item);
  }
};

const SetupPagination = (items, wrapper, rows_per_page) => {
  wrapper.innerHTML = "";
  const page_count = Math.ceil(items.length / rows_per_page);
  elem(page_count, current_page); // Call elem to generate pagination buttons
};

// const PaginationButton = (page, items) => {
//   const button = document.createElement("button");
//   button.innerText = page;
//   if (current_page === page) button.classList.add("active");
//   button.addEventListener("click", () => {
//     current_page = page;
//     DisplayList(items, list_element, rows, current_page);

//     const current_btn = document.querySelector("#pagination button.active");
//     if (current_btn) {
//       current_btn.classList.remove("active");
//     }

//     button.classList.add("active");

//     elem(Math.ceil(items.length / rows), current_page); // Update pagination buttons
//   });

//   return button;
// };

function elem(allPages, page) {
  let buttons = '';

  let beforePage = Math.max(1, page - 1);
  let afterPage = Math.min(allPages, page + 1);

  if (page > 1) {
    buttons += `<button class='move-btn' onclick="elem(${allPages}, ${page - 1})">&#10094;</button>`;
  }

  for (let i = beforePage; i <= afterPage; i++) {
    buttons += `<button class="${i === page ? 'active' : ''}" onclick="elem(${allPages}, ${i})"><span>${i}</span></button>`;
  }

  if (page < allPages) {
    buttons += `<button class='move-btn' onclick="elem(${allPages}, ${page + 1})">&#10095;</button>`;
  }

  pagination_element.innerHTML = buttons;
  DisplayList(list_items, list_element, rows, page);
}

SetupPagination(list_items, pagination_element, rows);