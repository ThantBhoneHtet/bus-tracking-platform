// ------------- For BusStop Table Section --------------- // (Start)


let row_t3 = document.querySelectorAll('#row-t3');
let paginate_t3 = document.querySelector('.container-t3');


row_t3.forEach(r_t3 => {
    if (r_t3.rowIndex > 8) {
        r_t3.style.display = "none";
    }
});
var rowCount_t3 = row_t3.length;


let paginationContainer_t3 = document.querySelector('#pagination-t3');
let paginationPage_t3 = document.querySelector('.pages-container-t3');

function createPaginateButton_t3(pageNum_t3) {
    const button_t3 = document.createElement('button');
    button_t3.classList.add('btn', 'page-link-t3');
    button_t3.innerHTML = `<div class="overlay btn-shadow"></div>
                            <div class="flex-center btn-content btn-number btn-secondary">
                                <div class="flex-center btn-text">
                                <span class="page-num-t3">${pageNum_t3}</span>
                                <span class="duplicate page-num-t3">${pageNum_t3}</span>
                            </div>
                        </div>`
    return button_t3;
}


    for (var i = 1; i <= 3; i++) {
        const button_t3 = createPaginateButton_t3(i);
        paginationPage_t3.appendChild(button_t3);
    }


// --------  Pagination Control  -------- // (Start)
let next_t3 = document.querySelector('#next-page-t3');
let previous_t3 = document.querySelector('#previous-page-t3');
let page_num_t3 = document.querySelectorAll('.page-num-t3');
let page_link_t3 = document.querySelectorAll('.page-link-t3');
let count = null;

let pageNumCount = Math.ceil(rowCount_t3 / 8);
page_link_t3.forEach(button => {
    let pageNum = Number(button.querySelector('.page-num-t3').innerHTML);
    if (pageNum > pageNumCount) {
        button.style.display = "none";
        next_t3.style.display = "none";
        count++;
    }
});
next_t3.onclick = () => {
    page_num_t3.forEach(p_t3 => {
        if (Number(page_num_t3[5].innerHTML) === pageNumCount - 3) { 
            next_t3.style.display = "none";
        }
        if (Number(page_num_t3[0].innerHTML) === pageNumCount - 2 && 
            Number(page_num_t3[2].innerHTML) === pageNumCount - 1 && 
            Number(page_num_t3[5].innerHTML) === pageNumCount) {
            return;
        } else {
            previous_t3.style.display = "block";             
            p_t3.innerHTML = Number(p_t3.innerHTML) + 3;
            page_link_t3.forEach(button => {
                let pageNum = Number(button.querySelector('.page-num-t3').innerHTML);
                if (pageNum > pageNumCount) {
                    button.style.display = "none";
                    next_t3.style.display = "none";
                    count++;
                }
            });
        }
    });
};

if (rowCount_t3 < 10) {
    paginationContainer_t3 .style.display = "none";
}


previous_t3.style.display = "none"; 
previous_t3.onclick = () => {
    page_num_t3.forEach(p_t3 => {
        if (Number(page_num_t3[0].innerHTML) === 1 && 
            Number(page_num_t3[2].innerHTML) === 2 && 
            Number(page_num_t3[4].innerHTML) === 4) {
            return;
        } else {
            if (Number(page_num_t3[0].innerHTML) === 1) {
                previous_t3.style.display = "none";
            }
            page_link_t3.forEach(button => {
                if (count > 0) {
                    button.style.display = "inline";
                }
            });
            next_t3.style.display = "block";
            p_t3.innerHTML = Number(p_t3.innerHTML) - 3;
        }
        count = 0;
    });
};

for (var i = 0; i < 3; i++) {
    (function(index_t3) {
        page_link_t3[index_t3].onclick = () => {
            let pageNo_t3 = Number(page_num_t3[index_t3 * 2].innerHTML);
            let start_index_t3 = (pageNo_t3 - 1) * 8;
            let end_index_t3 = start_index_t3 + 8;
        
            row_t3.forEach(r_t3 => {
                r_t3.style.display = "none";
        
                if (r_t3.rowIndex > start_index_t3 && r_t3.rowIndex <= end_index_t3) {
                    r_t3.style.display = "table-row";
                }
            });
        };
    })(i);
}
// --------  Pagination Control  -------- // (End)
// ------------- For BusStop Table Section --------------- // (End)

