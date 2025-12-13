// ------------- For BusStop Table Section --------------- // (Start)


let search_box_t2 = document.querySelector('.BusStop-input');
let row_t2 = document.querySelectorAll('#row-t2');
let paginate_t2 = document.querySelector('.container-t2');

setTimeout(function() {
        document.querySelector('.busStop-section').style.display = "block";
}, 400)

row_t2.forEach(r_t2 => {
    if (r_t2.rowIndex > 20) {
        r_t2.style.display = "none";
    }
});

var rowCount_t2 = row_t2.length;
search_box_t2.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        rowCount_t2 = 0;
        row_t2.forEach(r_t2 => {
            var att_t2 = r_t2.getAttribute("data-row");
            
            if (search_box_t2.value.toUpperCase() !== att_t2.toUpperCase()) {
                r_t2.style.display = "none";
            } else {
                r_t2.style.display = "table-row";
                paginationContainer_t2.style.display = "none";
                rowCount_t2++;
            }
        });
    }
    if (rowCount_t2 === 0) {
        paginationContainer_t2.style.display = "none";
    }
});

search_box_t2.addEventListener('input', function(e) {
    e.preventDefault();
    row_t2.forEach(r_t2 => {
        if (this.value == "") {
            r_t2.style.display = "table-row";
            paginationContainer_t2.style.display = "block";
            if (r_t2.rowIndex > 5) {
                r_t2.style.display = "none";
            }
             rowCount_t2 = row_t2.length;
        }

    });
});
console.log(rowCount_t2)

let paginationContainer_t2 = document.querySelector('#pagination-t2');
let paginationPage_t2 = document.querySelector('.pages-container-t2');

function createPaginateButton_t2(pageNum_t2) {
    const button_t2 = document.createElement('button');
    button_t2.classList.add('btn', 'page-link-t2');
    button_t2.innerHTML = `<div class="overlay btn-shadow"></div>
                            <div class="flex-center btn-content btn-number btn-secondary">
                                <div class="flex-center btn-text">
                                <span class="page-num-t2">${pageNum_t2}</span>
                                <span class="duplicate page-num-t2">${pageNum_t2}</span>
                            </div>
                        </div>`
    return button_t2;
}

if (rowCount_t2 > 5) {
    for (var i = 1; i <= 3; i++) {
        const button_t2 = createPaginateButton_t2(i);
        paginationPage_t2.appendChild(button_t2);
    }
}

// --------  Pagination Control  -------- // (Start)
let next_t2 = document.querySelector('#next-page-t2');
let previous_t2 = document.querySelector('#previous-page-t2');
let page_num_t2 = document.querySelectorAll('.page-num-t2');
let page_link_t2 = document.querySelectorAll('.page-link-t2');
let count = null;
let pageNumCount = Math.ceil(rowCount_t2/20);

page_link_t2.forEach(button => {
    let pageNum = Number(button.querySelector('.page-num-t2').innerHTML);
    if (pageNum > pageNumCount) {
        button.style.display = "none";
        next_t2.style.display = "none";
        count++;
    }
});
next_t2.onclick = () => {
    page_num_t2.forEach(p_t2 => {
        if (Number(page_num_t2[5].innerHTML) === pageNumCount-3){ 
            next_t2.style.display = "none";
        }
        if (Number(page_num_t2[0].innerHTML) === pageNumCount-2 && 
            Number(page_num_t2[2].innerHTML) === pageNumCount-1 && 
            Number(page_num_t2[5].innerHTML) === pageNumCount) {
            return;
        } else {
            previous_t2.style.display = "block";             
            p_t2.innerHTML = Number(p_t2.innerHTML) + 3;
            page_link_t2.forEach(button => {
                let pageNum = Number(button.querySelector('.page-num-t2').innerHTML);
                if (pageNum > pageNumCount) {
                    button.style.display = "none";
                    next_t2.style.display = "none";
                    count++;
                }
            });
        }
    });
 };

 previous_t2.style.display = "none"; 
 previous_t2.onclick = () => {
    page_num_t2.forEach(p_t2 => {
        if (Number(page_num_t2[0].innerHTML) === 1 && 
            Number(page_num_t2[2].innerHTML) === 2 && 
            Number(page_num_t2[4].innerHTML) === 4) {
            return
        } else {
            if(Number(page_num_t2[0].innerHTML) === 1){
                previous_t2.style.display = "none";
            }
            page_link_t2.forEach(button => {
                if (count > 0) {
                    button.style.display = "inline";
                }
            });
            next_t2.style.display = "block";
            p_t2.innerHTML = Number(p_t2.innerHTML) - 3;
        }
        count = 0;
    });
 };

for (var i = 0; i < 3; i++) {
    (function(index_t2) {
        page_link_t2[index_t2].onclick = () => {
            let pageNo_t2 = Number(page_num_t2[index_t2 * 2].innerHTML);
            let start_index_t2 = (pageNo_t2 - 1) * 20;
            let end_index_t2 = start_index_t2 + 20;
        
            row_t2.forEach(r_t2 => {
                r_t2.style.display = "none";
        
                if (r_t2.rowIndex > start_index_t2 && r_t2.rowIndex <= end_index_t2) {
                    r_t2.style.display = "table-row";
                }
            });
        };
    })(i);
}
// --------  Pagination Control  -------- // (End)
// ------------- For BusStop Table Section --------------- // (End)


