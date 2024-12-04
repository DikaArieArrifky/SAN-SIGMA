let btnSidebar = document.getElementById("menu-toggle");
let sidebaropen = document.getElementById("sidebar-open");
let sidebarclose = document.getElementById("sidebar-close");

let sidebariconopen = document.getElementById("sidebar-icon-open");
let navOpen = document.getElementById("nav-open");
let navClose = document.getElementById("nav-close");

sidebarclose.style.display = "none";
function setUiState(uiStateMap) {
  $.ajax({
    type: "POST",
    url: "setUiState",
    data: {
      set_ui_state: uiStateMap,
    },
    success: function () {
      console.log("Update UI State Success");
    },
    error: function (response) {
      console.log("[Update UI State]: " + response);
    },
  });
}

btnSidebar.addEventListener("click", () => {
  if (sidebaropen.style.display === "none") {
    sidebarMinimize();
    setUiState({ sidebarMinimize: true });
  } else {
    sidebarMax();
    setUiState({ sidebarMinimize: false });
  }
});

function sidebarMinimize() {

  sidebariconopen.style.transform = "rotate(180deg)";
  sidebarclose.style.display = "none";
  sidebariconopen.style.display = "block";
  sidebaropen.style.display = "block";
  sidebarclose.style.display = "none";
}


function sidebarMax() {
  sidebaropen.style.display = "none";
  sidebarclose.style.display = "block";
  sidebariconopen.style.transform = "rotate(90deg)";
  sidebariconopen.style.display = "block";
  navOpen.style.display = "block";
 
}

// Add event listener to sidebar menu buttons
document.querySelectorAll('.sidebar-menu-btn').forEach(button => {
  button.addEventListener('click', function() {
    // Remove active class from all buttons
    document.querySelectorAll('.sidebar-menu-btn').forEach(btn => btn.classList.remove('active'));
    // Add active class to the clicked button
    this.classList.add('active');
    // Store the active button in local storage
    localStorage.setItem('activeButton', this.value);
  });
});

// Restore the active button from local storage
document.addEventListener('DOMContentLoaded', () => {
  const activeButton = localStorage.getItem('activeButton');
  if (activeButton) {
    document.querySelectorAll(`.sidebar-menu-btn[value="${activeButton}"]`).forEach(btn => btn.classList.add('active'));
  }
});