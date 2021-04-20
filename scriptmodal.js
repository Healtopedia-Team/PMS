let currentlyOpenModals = {};
const noModalsOpen = () => !Object.keys(currentlyOpenModals).length;
const modalWrapper = document.querySelector(".modal-wrapper");

const openModal = modalId => {
  // If we're opening the first modal, make sure the wrapper becomes visible too
  if (noModalsOpen()) {
    modalWrapper.classList.add("visible");
  }

  const modal = document.getElementById(modalId);
  modal.classList.add("visible");
  currentlyOpenModals[modalId] = modal;
};

const closeModal = modalId => {
  if (noModalsOpen()) {
    return;
  }

  const modal = currentlyOpenModals[modalId];
  modal.classList.remove("visible");
  delete currentlyOpenModals[modalId];

  // If we closed the last open modal, hide the wrapper
  if (noModalsOpen()) {
    modalWrapper.classList.remove("visible");
  }
};

const closeAllModals = () => {
  // Iterate over the IDs in our map and close each modal with that ID
  Object.keys(currentlyOpenModals).forEach(closeModal);
};

const modalTriggers = document.querySelectorAll(".modal-trigger");
modalTriggers.forEach(modalTrigger => {
  modalTrigger.addEventListener("click", clickEvent => {
    const trigger = clickEvent.target;
    const modalId = trigger.getAttribute("data-modal-id");
    openModal(modalId);
  });
});

document.querySelectorAll(".modal-window").forEach(modal => {
  modal.addEventListener("click", clickEvent => {
    clickEvent.stopPropagation();
  });
});

modalWrapper.addEventListener("click", () => {
  closeAllModals();
});

document.querySelectorAll(".close-modal-button").forEach(closeModalButton => {
  closeModalButton.addEventListener("click", clickEvent => {
    const modalToClose = clickEvent.target.closest(".modal-window");
    closeModal(modalToClose.id);
  });
});

document.body.addEventListener("keyup", keyEvent => {
  if (keyEvent.key === "Escape") {
    closeAllModals();
  }
});

function myTime() {
  var x = document.getElementById("time").value;
  document.getElementById("demo").innerHTML = x;
}

function myValid(){
  var x = document.getElementById("date").value;
  if (x == "") {
    alert("Please select date first!");
  }else{
    var x = document.getElementById("date").value;
    document.getElementById("showdate").value= x;
    document.getElementById("demoss").innerHTML= x;
    document.getElementById("showdates").value= x;
  }
}

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}   