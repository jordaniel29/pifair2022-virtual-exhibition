function vote(teamId) {
  voteBtnId = "vote-" + teamId;
  var voteBtn = document.getElementsByClassName("vote");
  var unvoteBtn = document.getElementsByClassName("unvote");

  for (var i = 0; i < voteBtn.length; ++i) {
    if (voteBtn[i].id == voteBtnId) {
      changeSelectedBtnDisplay(voteBtn[i], unvoteBtn[i]);
    } else {
      changeOthersBtnDisplay(voteBtn[i]);
    }
  }
}

function changeSelectedBtnDisplay(voteBtn, unvoteBtn) {
  if (voteBtn.style.display != "none") {
    voteBtn.style.display = "none";
    unvoteBtn.style.display = "block";
  } else {
    voteBtn.style.display = "block";
    unvoteBtn.style.display = "none";
  }
}

function changeOthersBtnDisplay(voteBtn) {
  if (voteBtn.style.display != "none") {
    voteBtn.style.display = "none";
  } else {
    voteBtn.style.display = "block";
  }
}

function closeModal(teamId) {
  var ytId = "youtube-" + teamId;
  document.getElementById(ytId).src = document.getElementById(ytId).src;
  var teamModal = document.getElementById("modal-" + teamId);
  teamModal.style.display = "none";
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    this.closeModal();
  }
};

/* global AFRAME */
AFRAME.registerComponent("highlight", {
  init: function () {
    var buttonEls = (this.buttonEls = this.el.querySelectorAll(".menu-button"));
    var backgroundEl = document.querySelector("#background");
    this.onClick = this.onClick.bind(this);
    this.onMouseEnter = this.onMouseEnter.bind(this);
    this.onMouseLeave = this.onMouseLeave.bind(this);
    for (var i = 0; i < buttonEls.length; ++i) {
      buttonEls[i].addEventListener("mouseenter", this.onMouseEnter);
      buttonEls[i].addEventListener("mouseleave", this.onMouseLeave);
      buttonEls[i].addEventListener("click", this.onClick);
    }
  },

  onClick: function (evt) {
    var id = "modal-" + evt.currentTarget.id;
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    var teamModal = document.getElementById(id);
    teamModal.style.display = "block";
  },

  onMouseEnter: function (evt) {
    var buttonEls = this.buttonEls;
    evt.target.setAttribute("material", "color", "#046de7");
    for (var i = 0; i < buttonEls.length; ++i) {
      if (evt.target === buttonEls[i]) {
        continue;
      }
      buttonEls[i].setAttribute("material", "color", "white");
    }
  },

  onMouseLeave: function (evt) {
    if (this.el.is("clicked")) {
      return;
    }
    evt.target.setAttribute("material", "color", "white");
  },
});
