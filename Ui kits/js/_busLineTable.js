// ------------- For BusStop Table Section --------------- // (Start)

let search_box_t1 = document.querySelector('.BusLine-input');
let row_t1 = document.querySelectorAll('#row-t1');
let paginate_t1 = document.querySelector('.container-t1');


row_t1.forEach(r_t1 => {
    if (r_t1.rowIndex > 3) {
        r_t1.style.display = "none";
    }
});

let rowCount_t1 = row_t1.length;
search_box_t1.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        rowCount_t1 = 0;
        row_t1.forEach(r_t1 => {
            var att_t1 = r_t1.getAttribute("data-row");
            
            if(search_box_t1.value != att_t1) {
                r_t1.style.display = "none";
            } else {
                r_t1.style.display = "table-row";
                paginationContainer_t1.style.display = "none";
                rowCount_t1++;
            }
        });
    }
    if (rowCount_t1 === 0) {
        paginationContainer_t1.style.display = "none";
    }
});

search_box_t1.addEventListener('input', function(e) {
    e.preventDefault();
    row_t1.forEach(r_t1 => {
        if (this.value == "") {
            r_t1.style.display = "table-row";
            paginationContainer_t1.style.display = "block";
            if (r_t1.rowIndex > 2) {
                r_t1.style.display = "none";
            }
            rowCount_t1 = row_t1.length;
        }
    });    
});

console.log(rowCount_t1)
let paginationContainer_t1 = document.querySelector('#pagination-t1');
let paginationPage_t1 = document.querySelector('.pages-container-t1');

function createPaginateButton_t1(pageNum_t1) {
    const button_t1 = document.createElement('button');
    button_t1.classList.add('btn', 'page-link-t1');
    button_t1.innerHTML = `<div class="overlay btn-shadow"></div>
                            <div class="flex-center btn-content btn-number btn-secondary">
                                <div class="flex-center btn-text">
                                <span class="page-num-t1">${pageNum_t1}</span>
                                <span class="duplicate page-num-t1">${pageNum_t1}</span>
                            </div>
                        </div>`;
    return button_t1;
}

if (rowCount_t1 > 2) {
    for (var i = 1; i <= 3; i++) {
        const button_t1 = createPaginateButton_t1(i);
        paginationPage_t1.appendChild(button_t1);
    }
}



// --------  Pagination Control  -------- // (Start)
let next_t1 = document.querySelector('#next-page-t1');
let previous_t1 = document.querySelector('#previous-page-t1')
let page_num_t1 = document.querySelectorAll('.page-num-t1');
let page_link_t1 = document.querySelectorAll('.page-link-t1');
let count = null;
let pageNumCount = Math.ceil(rowCount_t1/3);

page_link_t1.forEach(button => {
    let pageNum = Number(button.querySelector('.page-num-t1').innerHTML);
    if (pageNum > pageNumCount) {
        button.style.display = "none";
        next_t1.style.display = "none";
        count++;
    }
});
next_t1.onclick = () => {
    page_num_t1.forEach(p_t1 => {
        if (Number(page_num_t1[5].innerHTML) === pageNumCount-3){ 
            next_t1.style.display = "none";
        }
        if (Number(page_num_t1[0].innerHTML) === pageNumCount-2 && 
            Number(page_num_t1[2].innerHTML) === pageNumCount-1 && 
            Number(page_num_t1[5].innerHTML) === pageNumCount) {
            return;
        } else {
            previous_t1.style.display = "block";             
            p_t1.innerHTML = Number(p_t1.innerHTML) + 3;
            page_link_t1.forEach(button => {
                let pageNum = Number(button.querySelector('.page-num-t1').innerHTML);
                if (pageNum > pageNumCount) {
                    button.style.display = "none";
                    next_t1.style.display = "none";
                    count++;
                }
            });
        }
    });
 };


 previous_t1.style.display = "none"; 
 previous_t1.onclick = () => {
    page_num_t1.forEach(p_t1 => {
        if (Number(page_num_t1[0].innerHTML) === 1 && 
            Number(page_num_t1[2].innerHTML) === 2 && 
            Number(page_num_t1[4].innerHTML) === 4) {
            return
        } else {
            if(Number(page_num_t1[0].innerHTML) === 1){
                previous_t1.style.display = "none";
            }
            page_link_t1.forEach(button => {
                if (count > 0) {
                    button.style.display = "inline";
                }
            });
            next_t1.style.display = "block";
            p_t1.innerHTML = Number(p_t1.innerHTML) - 3;
        }
        count = 0;
    });
 };



for (var i = 0; i < 3; i++) {
    (function(index) {
            page_link_t1[index].onclick = () => {

            let pageNo_t1 = Number(page_num_t1[index * 2].innerHTML);
            let start_index = (pageNo_t1 - 1) * 3;
            let end_index = start_index + 3;
        
            row_t1.forEach(r_t1 => {
                r_t1.style.display = "none";
                if (r_t1.rowIndex > start_index && r_t1.rowIndex <= end_index) {
                    r_t1.style.display = "table-row";
                }
            });
        };
    })(i);
};


// --------  Pagination Control  -------- // (End)
// ------------- For BusStop Table Section --------------- // (End)
