const feedbackOpenBtn = document.querySelector('.feedback-btn');
const feedbackCloseBtn = document.querySelector('.feedback-close-btn');
const feedbackOverlay = document.querySelector('.feedback-overlay');
const feedbackBox = document.querySelector('.feedback-container');
const reminderNotiOverlay = document.querySelector('.reminder-noti-overlay');
const reminderNotiBox = document.querySelector('.reminder-noti-container');
const reminderNotiCloseBtn = document.querySelector('.reminder-noti-close-btn');
// home variables
const nearestBusStopsBoxOpenBtn = document.querySelector(
  '.nearest-bus__stops-open-btn'
);
const routesBoxOpenBtn = document.querySelector('.routes-open-btn');
const busLinesBoxOpenBtn = document.querySelector('.bus__lines-open-btn');
const busStopsBoxOpenBtn = document.querySelector('.bus__stops-open-btn');
const saveBoxOpenBtn = document.querySelector('.save__routes-open-btn');
const historyBoxOpenBtn = document.querySelector('.history-open-btn');

const nearestBusStopsBoxCloseBtn = document.querySelector(
  '.nearest-bus__stops-close-btn'
);
const trackBusLineBoxCloseBtn = document.querySelector(
  '.track-bus__line-close-btn'
);
const trackBusLineInfoBoxCloseBtn = document.querySelector(
  '.track-bus__line-info-close-btn'
);
const routesBoxCloseBtn = document.querySelector('.routes-close-btn');
const busLinesBoxCloseBtn = document.querySelector('.bus__lines-close-btn');
const busLineDetailCloseBtn = document.querySelector(
  '.bus__line-detail-close-btn'
);
const busStopsBoxCloseBtn = document.querySelector('.bus__stops-close-btn');
const busStopDetailCloseBtn = document.querySelector(
  '.bus__stop-detail-close-btn'
);
const saveBoxCloseBtn = document.querySelector('.save__routes-close-btn');
const saveRoutesDetailCloseBtn = document.querySelector(
  '.save__routes-detail-close-btn'
);
const saveRouteOptCloseBtn = document.querySelector(
  '.saveRoute__opt-close-btn'
);
const historyBoxCloseBtn = document.querySelector('.history-close-btn');

const nearestBusStopsBox = document.querySelector(
  '.nearest-bus__stops-container'
);
const trackBusLineBox = document.querySelector('.track-bus__line-container');
const trackBusLineInfoBox = document.querySelector(
  '.track-bus__line-info-container'
);
const routesBox = document.querySelector('.routes-container');
const busLinesBox = document.querySelector('.bus__lines-container');
const busLineDetailBox = document.querySelector('.bus__line-detail-container');
const busStopsBox = document.querySelector('.bus__stops-container');
const busStopDetailBox = document.querySelector('.bus__stop-detail-container');
const saveRoutesBox = document.querySelector('.save__routes-container');
const saveRouteDetailBox = document.querySelector(
  '.save__route-detail-container'
);
const historyBox = document.querySelector('.history-container');
const saveRouteOptBox = document.querySelector('.saveRoute__opt-container');

const saveRouteOptOverlay = document.querySelector('.saveRoute__opt-overlay');

const nearestBusStops = document.querySelectorAll('.nearest-bus__stop');
const trackBusLines = document.querySelectorAll('.track-bus__line');
const routes = document.querySelectorAll('.route');
const busLines = document.querySelectorAll('.bus__line');
const busStops = document.querySelectorAll('.bus__stop');
const saveRoutes = document.querySelectorAll('.save__route');
const histories = document.querySelectorAll('.history');
const save_at_home = document.querySelector('.home_directory');
const save_at_work = document.querySelector('.work_directory');
const save_at_school = document.querySelector('.school_directory');

// admin variables

// account variables

// reset variables

// cursor variables
const trackBusLineHoverBox = document.querySelector(
  '.track-bus__line-hover-container'
);
const routesHoverBox = document.querySelector('.routes-hover-container');
const busLineHoverBox = document.querySelector('.bus__line-hover-container');
const busStopHoverBox = document.querySelector('.bus__stop-hover-container');
const saveRouteHoverBox = document.querySelector(
  '.save__route-hover-container'
);
const historyHoverBox = document.querySelector('.history-hover-container');

// home
const openPopupBox = function (container) {
  nearestBusStopsBoxOpenBtn.classList.remove('nav__lists-active');
  routesBoxOpenBtn.classList.remove('nav__lists-active');
  busStopsBoxOpenBtn.classList.remove('nav__lists-active');
  busLinesBoxOpenBtn.classList.remove('nav__lists-active');
  saveBoxOpenBtn.classList.remove('nav__lists-active');
  historyBoxOpenBtn.classList.remove('nav__lists-active');
  nearestBusStopsBox.classList.remove('popup-box-show');
  trackBusLineBox.classList.remove('popup-box-show');
  routesBox.classList.remove('popup-box-show');
  busLinesBox.classList.remove('popup-box-show');
  busLineDetailBox.classList.remove('popup-box-show');
  busStopsBox.classList.remove('popup-box-show');
  busStopDetailBox.classList.remove('popup-box-show');
  saveRoutesBox.classList.remove('popup-box-show');
  saveRouteDetailBox.classList.remove('popup-box-show');
  historyBox.classList.remove('popup-box-show');

  // update present container
  document
    .querySelector(`.${container}-open-btn`)
    .classList.add('nav__lists-active');
  document
    .querySelector(`.${container}-container`)
    .classList.add('popup-box-show');
};

const openPopupDetailBox = function (container) {
  nearestBusStopsBoxOpenBtn.classList.remove('nav__lists-active');
  routesBoxOpenBtn.classList.remove('nav__lists-active');
  busStopsBoxOpenBtn.classList.remove('nav__lists-active');
  busLinesBoxOpenBtn.classList.remove('nav__lists-active');
  saveBoxOpenBtn.classList.remove('nav__lists-active');
  historyBoxOpenBtn.classList.remove('nav__lists-active');
  nearestBusStopsBox.classList.remove('popup-box-show');
  trackBusLineBox.classList.remove('popup-box-show');
  routesBox.classList.remove('popup-box-show');
  busLinesBox.classList.remove('popup-box-show');
  busLineDetailBox.classList.remove('popup-box-show');
  busStopsBox.classList.remove('popup-box-show');
  busStopDetailBox.classList.remove('popup-box-show');
  saveRoutesBox.classList.remove('popup-box-show');
  saveRouteDetailBox.classList.remove('popup-box-show');
  historyBox.classList.remove('popup-box-show');

  // update present container
  document
    .querySelector(`.${container}s-open-btn`)
    .classList.add('nav__lists-active');
  document
    .querySelector(`.${container}-detail-container`)
    .classList.add('popup-box-show');
};


document.querySelector('form').addEventListener('submit', (e) => {
  // e.preventDefault()
})

const saveRouteBoxDisplay = function () {
  saveRouteOptBox.classList.toggle('saveRoute__opt-box-show');
  saveRouteOptOverlay.classList.toggle('saveRoute__opt-overlay-show');
};



feedbackOpenBtn.addEventListener('click', () => {
  feedbackBox.classList.toggle('feedback-box-show');
  feedbackOverlay.classList.toggle('feedback-overlay-show');
});

feedbackOverlay.addEventListener('click', () => {
  feedbackBox.classList.toggle('feedback-box-show');
  feedbackOverlay.classList.toggle('feedback-overlay-show');
});

feedbackCloseBtn.addEventListener('click', () => {
  feedbackBox.classList.toggle('feedback-box-show');
  feedbackOverlay.classList.toggle('feedback-overlay-show');
});

reminderNotiOverlay.addEventListener('click', () => {
  reminderNotiBox.classList.toggle('feedback-box-show');
  reminderNotiOverlay.classList.toggle('feedback-overlay-show');
});

reminderNotiCloseBtn.addEventListener('click', () => {
  reminderNotiBox.classList.toggle('feedback-box-show');
  reminderNotiOverlay.classList.toggle('feedback-overlay-show');
});


trackBusLineBoxCloseBtn.addEventListener('click', () => {
  trackBusLineBox.classList.remove('popup-box-show');
  nearestBusStopsBox.classList.add('popup-box-show');
});

for (let i = 0; i < busLines.length; i++) {
  busLines[i].addEventListener('click', (e) => {
    e.preventDefault();
    openPopupDetailBox('bus__line');
  });
}

busLineDetailCloseBtn.addEventListener('click', () => {
  busLineDetailBox.classList.remove('popup-box-show');
  busLinesBox.classList.add('popup-box-show');
});

for (let i = 0; i < busStops.length; i++) {
  busStops[i].addEventListener('click', (e) => {
    e.preventDefault();
    openPopupDetailBox('bus__stop');
  });
}

busStopDetailCloseBtn.addEventListener('click', () => {
  busStopDetailBox.classList.remove('popup-box-show');
  busStopsBox.classList.add('popup-box-show');
});

// for (let i = 0; i < saves.length; i++) {
//   saves[i].addEventListener('click', (e) => {
//     e.preventDefault();
//     openPopupDetailBox('save__route');
//   });
// }


saveRoutesDetailCloseBtn.addEventListener('click', () => {
  saveRouteDetailBox.classList.remove('popup-box-show');
  saveRoutesBox.classList.add('popup-box-show');
});

nearestBusStopsBoxOpenBtn.addEventListener('click', () => {
  openPopupBox('nearest-bus__stops');
});


busLinesBoxOpenBtn.addEventListener('click', () => {
  openPopupBox('bus__lines');
});

busStopsBoxOpenBtn.addEventListener('click', () => {
  openPopupBox('bus__stops');
});

saveBoxOpenBtn.addEventListener('click', () => {
  openPopupBox('save__routes');
});

historyBoxOpenBtn.addEventListener('click', () => {
  openPopupBox('history');
});

nearestBusStopsBoxCloseBtn.addEventListener('click', () => {
  nearestBusStopsBoxOpenBtn.classList.remove('nav__lists-active');
  nearestBusStopsBox.classList.remove('popup-box-show');
});



busLinesBoxCloseBtn.addEventListener('click', () => {
  busLinesBoxOpenBtn.classList.remove('nav__lists-active');
  busLinesBox.classList.remove('popup-box-show');
});

busStopsBoxCloseBtn.addEventListener('click', () => {
  busStopsBoxOpenBtn.classList.remove('nav__lists-active');
  busStopsBox.classList.remove('popup-box-show');
});

saveBoxCloseBtn.addEventListener('click', () => {
  saveBoxOpenBtn.classList.remove('nav__lists-active');
  saveRoutesBox.classList.remove('popup-box-show');
});

historyBoxCloseBtn.addEventListener('click', () => {
  historyBoxOpenBtn.classList.remove('nav__lists-active');
  historyBox.classList.remove('popup-box-show');
});


saveRouteOptOverlay.addEventListener('click', () => {
  saveRouteBoxDisplay();
});

saveRouteOptCloseBtn.addEventListener('click', () => {
  saveRouteBoxDisplay();
});

// cursor
window.addEventListener('mousemove', cursor);

function cursor(e) {
  trackBusLineHoverBox.style.top = `${e.pageY}px`;
  trackBusLineHoverBox.style.left = `${e.pageX}px`;
  busLineHoverBox.style.top = `${e.pageY}px`;
  busLineHoverBox.style.left = `${e.pageX}px`;
  busStopHoverBox.style.top = `${e.pageY}px`;
  busStopHoverBox.style.left = `${e.pageX}px`;
  saveRouteHoverBox.style.top = `${e.pageY}px`;
  saveRouteHoverBox.style.left = `${e.pageX}px`;
  historyHoverBox.style.top = `${e.pageY}px`;
  historyHoverBox.style.left = `${e.pageX}px`;
}

document.body.addEventListener('mouseover', (e) => {
  if (e.target.closest('.nearest-bus__stop')) {
    busStopHoverBox.classList.add('bus__stop-hover-container-show');
  } else {
    busStopHoverBox.classList.remove('bus__stop-hover-container-show');

  }
})


for (let i = 0; i < routes.length; i++) {
  routes[i].addEventListener('mouseover', () => {
    routesHoverBox.classList.add('bus__stop-hover-container-show');
  });

  routes[i].addEventListener('mouseleave', () => {
    routesHoverBox.classList.remove('bus__stop-hover-container-show');
  });
}


document.body.addEventListener('mouseover', (e) => {

  if (e.target.closest('.bus__line')) {
    busLineHoverBox.classList.add('bus__line-hover-container-show');
  } else {
    busLineHoverBox.classList.remove('bus__line-hover-container-show');
  }
  if (e.target.closest('.bus__stop') || e.target.closest('.nearest-bus__stop') || e.target.closest('.track-bus__line')) {
    if (e.target.closest('.track-bus__line')) {
      document.querySelector('.track-text').innerHTML = "click to track this bus";
      busStopHoverBox.classList.add('bus__stop-hover-container-show');
    } else {
      document.querySelector('.track-text').innerHTML = "click to see bus stop details";
      busStopHoverBox.classList.add('bus__stop-hover-container-show');
    }
  } else {
    busStopHoverBox.classList.remove('bus__stop-hover-container-show');
  }

  if (e.target.closest('.save__route') || e.target.closest('.route')) {
    if (e.target.closest('.route')) {
      document.querySelector('.route-text').innerHTML = "click to make route";
      saveRouteHoverBox.classList.add('save__route-hover-container-show');
    }else {
      document.querySelector('.route-text').innerHTML = "click to make route again";
      saveRouteHoverBox.classList.add('save__route-hover-container-show');
    }
  } else {
    saveRouteHoverBox.classList.remove('save__route-hover-container-show');
  }

  if (e.target.closest('.history')) {
    historyHoverBox.classList.add('history-hover-container-show');
  } else {
    historyHoverBox.classList.remove('history-hover-container-show');
  }

})



// ------------------------- BusLine -----------------------//
let search_box_busLine = document.querySelector('.busLine_search');
let busLine_row = document.querySelectorAll('a.bus__line');
let scroll_more_busLine = document.querySelector('.scroll-busLine');

let rowCount_busLine = busLine_row.length;
if (rowCount_busLine < 6) {
  scroll_more_busLine.style.display = "none";
}
search_box_busLine.addEventListener('keydown', function (e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    rowCount_busLine = 0;
    busLine_row.forEach(r_t1 => {
      var att_t1 = r_t1.getAttribute("busLine-row");
      scroll_more_busLine.style.display = "none";

      if (search_box_busLine.value != att_t1) {
        r_t1.style.display = "none";
      } else {
        r_t1.style.display = "flex";
        rowCount_busLine++;
      }
    });
  }
});

search_box_busLine.addEventListener('input', function (e) {
  e.preventDefault();
  busLine_row.forEach((r_t1, index) => {
    if (this.value == "") {
      r_t1.style.display = "flex";
      scroll_more_busLine.style.display = "block";
      rowCount_busLine = busLine_row.length;
    } else {
      var att_t1 = r_t1.getAttribute("busLine-row");

      if (att_t1.indexOf(this.value) == 0) {
        r_t1.style.display = "flex";
      } else {
        r_t1.style.display = "none";
      }
    }
  });
});

busLine_row.forEach(r_t1 => {
  var att_t1 = r_t1.getAttribute("busLine-row");
  r_t1.addEventListener('click', () => {
    search_box_busLine.value = att_t1;
  })
});

// ------------------------- BusStop -----------------------//
let search_box_busStop = document.querySelector('.busStop_search');
let busStop_row = document.querySelectorAll('a.bus__stop');
let scroll_more_busStop = document.querySelector('.scroll-busStop');


let rowCount_busStop = busStop_row.length;
if (rowCount_busStop < 6) {
  scroll_more_busStop.style.display = "none";
}

search_box_busStop.addEventListener('keydown', function (e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    rowCount_busStop = 0;
    busStop_row.forEach(r_t2 => {
      var att_t2 = r_t2.getAttribute("busStop-name");
      scroll_more_busStop.style.display = "none";

      if (search_box_busStop.value.toUpperCase() !== att_t2.toUpperCase()) {
        r_t2.style.display = "none";
      } else {
        r_t2.style.display = "flex";
        rowCount_busStop++;
      }
    });
  }
});

search_box_busStop.addEventListener('input', function (e) {
  e.preventDefault();
  rowCount_busStop = 0;

  busStop_row.forEach(r_t2 => {
    if (this.value == "") {
      r_t2.style.display = "flex";
      scroll_more_busStop.style.display = "block";
      rowCount_busStop++;

    } else {

      var att_t2 = r_t2.getAttribute("busStop-name");
      var input = this.value.toUpperCase();

      if (att_t2.toUpperCase().indexOf(input) == 0) {
        scroll_more_busStop.style.display = "block";

        r_t2.style.display = "flex";
        rowCount_busStop++;
      } else {
        r_t2.style.display = "none";
      }
    }
  });
  if (rowCount_busStop <= 6) {
    scroll_more_busStop.style.display = "none";
  }
});



busStop_row.forEach(r_t2 => {
  var att_t2 = r_t2.getAttribute("busStop-name");
  r_t2.addEventListener('click', () => {
    search_box_busStop.value = att_t2;
  })
});


// ------------------------- BusLine Detail Info-----------------------//

let busStop_lists = document.querySelector('.bus__stops-lists');

document.body.addEventListener('click', function (e) {
  if (e.target.closest('.bus__line')) {
    while (busStop_lists.firstChild) {
      busStop_lists.removeChild(busStop_lists.firstChild)
    }
    const busLine = e.target.closest('.bus__line');
    e.preventDefault();
    busStopsBoxOpenBtn.classList.remove('nav__lists-active');
    busLinesBoxOpenBtn.classList.add('nav__lists-active');
    busLineDetailBox.classList.add('popup-box-show');
    busLinesBox.classList.remove('popup-box-show');
    busStopDetailBox.classList.remove('popup-box-show');

    let busNo = busLine.querySelector('.bus_number');
    busNo = busNo.textContent.trim();
    document.querySelector('.busNo').innerHTML = busNo;

    fetch(`Detail(busLine).php?busNo=${encodeURIComponent(busNo)}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text(); // Parse the response as text
      })
      .then(data => {
        data = JSON.parse(data)
        data.forEach(d => {
          const lists = add_detail_busLine(d.name_en, d.name_mm)
          busStop_lists.appendChild(lists);
        })
      })
  }
})


function add_detail_busLine(name_en, name_mm) {
  let a = document.createElement('a');
  a.classList.add('bus__content', 'bus__stop');
  a.setAttribute('href', '#');
  a.innerHTML = ` <div>
            <button href="" class="btn">
              <div class="overlay btn-shadow"></div>
              <div class="flex-center btn-content btn-icon btn-secondary">
                <div class="flex-center btn-text">
                  <span><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 384 512"
                      class="icon">
                      <path
                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg></span>
                  <span class="duplicate"><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 384 512"
                      class="icon">
                      <path
                        d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                    </svg></span>
                </div>
              </div>
            </button>
          </div>
          <div class="bus__line-info">
            <p class="name__en">${name_en}</p>
            <p class="name__mm myanmar-text">${name_mm}</p>
          </div>`
  return a;
}



// ------------------------- BusStop Detail Info-----------------------//
let busLine_lists = document.querySelector('#bus__lines-lists');
document.body.addEventListener('click', function (e) {
  if (e.target.closest('.bus__stop')) {

    while (busLine_lists.firstChild) {
      busLine_lists.removeChild(busLine_lists.firstChild)
    }

    const busStop = e.target.closest('.bus__stop');
    e.preventDefault();
    busStopsBoxOpenBtn.classList.add('nav__lists-active');
    busLinesBoxOpenBtn.classList.remove('nav__lists-active');
    busStopDetailBox.classList.add('popup-box-show');
    busStopsBox.classList.remove('popup-box-show');
    busLineDetailBox.classList.remove('popup-box-show');

    let busStop_name = busStop.querySelector('.name__en');
    busStop_name = busStop_name.textContent.trim();
    document.querySelector('.busStop_name_detail').innerHTML = busStop_name;

    fetch(`Detail(busStop).php?busStop=${encodeURIComponent(busStop_name)}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text(); // Parse the response as text
      })
      .then(data => {
        data = JSON.parse(data)
        console.log(data);
        data.forEach(d => {
          const lists = add_detail_busStop(d.bus_line_id, d.start, d.end)
          busLine_lists.appendChild(lists);
        })
      })
  }
})


function add_detail_busStop(busNo, from, to) {
  let a = document.createElement('a');
  a.classList.add('bus__content', 'bus__line');
  a.setAttribute('href', '#');
  a.innerHTML = ` <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span class="bus_number">${busNo}</span>
                    <span class="duplicate">${busNo}</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text">${from}</span>
              </p>
              <p class="to">to <span class="myanmar-text">${to}</span></p>
            </div>`;
  return a;
}









// ------------------------- History -----------------------//
let search_box_history = document.querySelector('.history_search');
let history_row = document.querySelectorAll('a.history');
let scroll_more_history = document.querySelector('.scroll-history');

let rowCount_history = history_row.length;
if (rowCount_history < 6) {
  scroll_more_history.style.display = "none";
}


document.body.addEventListener('click', (e) => {
  if (e.target.closest('a.history')) {
    const history = e.target.closest('a.history');
    e.preventDefault();
    saveRouteBoxDisplay();
    let saved_route = history.querySelector('.saved_route');
    saved_route = saved_route.textContent.trim();
    document.querySelector(".route_saved_home").innerHTML = saved_route;
    document.querySelector(".route_saved_work").innerHTML = saved_route;
    document.querySelector(".route_saved_school").innerHTML = saved_route;
  }
});


// ------------------------- Save Route -----------------------//
const saved_route_lists = document.querySelector('.save__routes-lists')

document.querySelector('.home_saved').addEventListener('click', () => {
  const saved_route = document.querySelector('.route_saved_home').innerHTML;
  fetch(`AcceptRoute.php?route=${encodeURIComponent(saved_route)}&directory=home`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
  saveRouteBoxDisplay();
})

document.querySelector('.school_saved').addEventListener('click', () => {
  const saved_route = document.querySelector('.route_saved_school').innerHTML;
  fetch(`AcceptRoute.php?route=${encodeURIComponent(saved_route)}&directory=school`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
  saveRouteBoxDisplay();
})

document.querySelector('.work_saved').addEventListener('click', () => {
  const saved_route = document.querySelector('.route_saved_work').innerHTML;
  fetch(`AcceptRoute.php?route=${encodeURIComponent(saved_route)}&directory=work`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
  saveRouteBoxDisplay();
})


save_at_home.addEventListener('click', (e) => {
  e.preventDefault();
  while (saved_route_lists.firstChild) {
    saved_route_lists.removeChild(saved_route_lists.firstChild)
  }
  openPopupDetailBox('save__route');
  fetch('fetchsavedata.php?dir=home')
    .then(response => {
      return response.json();
    })
    .then(data => {
      data.forEach(d => {
        let route = JSON.parse(d.Route);
        let lists = add_saved_list(route[0].name_mm, route[route.length - 1].name_mm, d.Route, d.Route_Id);
        document.querySelector('.save__routes-lists').appendChild(lists);

      })
      document.querySelector('.dir-title').innerHTML = "Home";
      document.querySelector('.save_routes-no').innerHTML = saved_route_lists.children.length;
      if (saved_route_lists.children.length <= 1) {
        document.querySelector('.save_routes-count').innerHTML = "route";
      }
    })

})

save_at_work.addEventListener('click', (e) => {
  e.preventDefault();
  while (saved_route_lists.firstChild) {
    saved_route_lists.removeChild(saved_route_lists.firstChild)
  }
  openPopupDetailBox('save__route');


  fetch('fetchsavedata.php?dir=work')
    .then(response => {
      return response.json();
    })
    .then(data => {
      data.forEach(d => {
        let route = JSON.parse(d.Route);
        let lists = add_saved_list(route[0].name_mm, route[route.length - 1].name_mm, d.Route,d.Route_Id);
        saved_route_lists.appendChild(lists);
      })
      document.querySelector('.dir-title').innerHTML = "Work";
      document.querySelector('.save_routes-no').innerHTML = saved_route_lists.children.length;
      if (saved_route_lists.children.length <= 1) {
        document.querySelector('.save_routes-count').innerHTML = "route";
      }
    })

})
save_at_school.addEventListener('click', (e) => {
  e.preventDefault();


  while (saved_route_lists.firstChild) {
    saved_route_lists.removeChild(saved_route_lists.firstChild)
  }
  openPopupDetailBox('save__route');

  fetch('fetchsavedata.php?dir=school')
    .then(response => {
      return response.json();
    })
    .then(data => {
      data.forEach(d => {
        let route = JSON.parse(d.Route);
        let lists = add_saved_list(route[0].name_mm, route[route.length - 1].name_mm, d.Route, d.Route_Id);
        saved_route_lists.appendChild(lists);
      })
      
      document.querySelector('.dir-title').innerHTML = "School";
      document.querySelector('.save_routes-no').innerHTML = saved_route_lists.children.length;
      if (saved_route_lists.children.length <= 1) {
        document.querySelector('.save_routes-count').innerHTML = "route";
      }
    })

})


function add_saved_list(from, to, route,id) {
  let a = document.createElement('a');
  a.classList.add('bus__content', 'save__route');
  a.setAttribute('href', '#');
  a.innerHTML = ` <div class="save__route-content">
  <div>
            <button href="" class="btn">
              <p class="route-to-draw" hidden>${route}</p>
              <p class="id" hidden>${id}</p>
              <div class="overlay btn-shadow"></div>
              <div class="flex-center btn-content btn-icon btn-secondary">
                <div class="flex-center btn-text">
                  <span
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                      class="icon"
                    >
                      <path
                        d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"
                      /></svg
                  ></span>
                  <span class="duplicate"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                      class="icon"
                    >
                      <path
                        d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"
                      /></svg
                  ></span>
                </div>
              </div>
            </button>
          </div>
          <div class="bus__line-info">
            <p class="from">
              from <span class="myanmar-text">${from}</span>
            </p>
            <p class="to">to <span class="myanmar-text">${to}</span></p>
          </div>
        </div>
            <div class="">
            <button href="" class="btn save-delete-btn">
              <p class="route-id" hidden>${id}</p>
              <div class="overlay btn-shadow"></div>
              <div class="flex-center btn-icon btn-delete">
                <div class="flex-center btn-text">
                  <span
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 384 512"
                      class="remove-icon"
                    >
                      <path
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                      /></svg
                  ></span>
                  <span class="duplicate"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 384 512"
                      class="delete-icon"
                    >
                      <path
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                      /></svg
                  ></span>
                </div>
              </div>
            </button>
          </div>`;
  return a;
}

document.querySelector('.new__save').onclick = () => {
  openPopupBox('routes');
}

document.querySelector('.save-route').onclick = () => {
  saveRouteBoxDisplay();
  document.querySelector(".route_saved_home").innerHTML = document.querySelector('#to_save-route').innerHTML;
  document.querySelector(".route_saved_work").innerHTML = document.querySelector('#to_save-route').innerHTML;
  document.querySelector(".route_saved_school").innerHTML = document.querySelector('#to_save-route').innerHTML;
}

document.body.addEventListener('click', (e) => {
  if (e.target.closest('.save-delete-btn')) {
    let deletesave = e.target.closest('.save-delete-btn');
    let id = deletesave.querySelector('.route-id').innerHTML;
    if (e.target.closest('.save__route')) {
      let save = e.target.closest('.save__route');
      let saveid = save.querySelector('.id').innerHTML;
      save.remove();
    }
    fetch(`./DeleteSaveRoute.php?routeid=${id}`)
      .then(response => {
        return response.text();
      })
    document.querySelector('.save_routes-no').innerHTML =    document.querySelector('.save_routes-no').innerHTML - 1;
  }
})

// ------------------------- Tracking -----------------------//
const track_busLine_lists = document.querySelector('.bus__line-track-lists');
document.body.addEventListener('click', function (e) {
  if (e.target.closest('.nearest-bus__stop')) {
    while (track_busLine_lists.firstChild) {
      track_busLine_lists.removeChild(track_busLine_lists.firstChild)
    }
    const busStop = e.target.closest('.nearest-bus__stop');
    e.preventDefault();
    openPopupBox('nearest-bus__stops');
    nearestBusStopsBox.classList.remove('popup-box-show');
    trackBusLineBox.classList.add('popup-box-show');


    let busStop_name = busStop.querySelector('.name__en');
    busStop_name = busStop_name.textContent.trim();
    document.querySelector('.busStop_name').innerHTML = busStop_name;

    fetch(`Detail(busStop).php?busStop=${encodeURIComponent(busStop_name)}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text(); // Parse the response as text
      })
      .then(data => {
        data = JSON.parse(data)
        data.forEach(d => {
          const lists = add_track_busStop(d.bus_line_id, busStop_name , d.start, d.end)
          track_busLine_lists.appendChild(lists);
        })
      })
  }
})

function add_track_busStop(busNo, busStop_name,from, to) {
  let a = document.createElement('a');
  a.classList.add('bus__content', 'track-bus__line');
  a.setAttribute('href', '#');
  a.innerHTML = ` <div>
              <button class="btn">
                <p id="busStop_name-track" hidden>${busStop_name}</p>
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span class="bus_number">${busNo}</span>
                    <span class="duplicate">${busNo}</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="from">
                from <span class="myanmar-text">${from}</span>
              </p>
              <p class="to">to <span class="myanmar-text">${to}</span></p>
            </div>`;
  return a;
}


document.body.addEventListener('click', function (e) {
  if (e.target.closest('.track-bus__line')) {

    e.preventDefault();
    nearestBusStopsBox.classList.remove('popup-box-show');
    // trackBusLineBox.classList.remove('popup-box-show');
  }
})

trackBusLineInfoBoxCloseBtn.onclick = () => {
    trackBusLineInfoBox.classList.remove('popup-box-show');
    trackBusLineBox.classList.add('popup-box-show');
}



// ------------------------- Draw Route -----------------------//
routesBoxOpenBtn.addEventListener('click', () => {
  openPopupBox('routes');
});

document.querySelector('#search-btn').addEventListener('click', (e) => {
  if (document.querySelector('#start-point input').value != "") {
    if (document.querySelector('#end-point input').value != "") {
      document.querySelector('.choose_busLine_to_route').style.display = "block";
    }
  }
})

document.body.addEventListener('click', (e) => {
  if (e.target.closest('.route')) {
    let route = e.target.closest('.route');
    let busNo= route.querySelector('#busLine_No').innerHTML;
    document.querySelector('.chosen_busline').innerHTML = busNo;
    document.querySelector(`.chosen_busline-container`).classList.add('popup-box-show');

  }
})

routesBoxCloseBtn.addEventListener('click', () => {
  document.querySelector('#start-point input').value  = "";
  document.querySelector('#end-point input').value  = "";
})

document.querySelector('.track-bus__line_route-info-close-btn').onclick = () => {
  document.querySelector(`.chosen_busline-container`).classList.remove('popup-box-show');
}



//--------- Feedback -------------//
document.querySelector('.feedback-submit-btn').onclick = () => {
  let input = document.querySelector('#feedbackText').value ;
  if (input != "") {
    fetch(`feedback.php?feedback=${input}`)
     .then(response => {
      return response.text();
     })
     feedbackBox.classList.toggle('feedback-box-show');
     feedbackOverlay.classList.toggle('feedback-overlay-show');
  }
}