@extends('layouts.master_admin')
@section('index_product')
<style>
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        width: 80%;
        height: 80%;
    }

    .popup-content {
        width: 90%;
        height: 90%;
        overflow-y: auto;
    }

    .popup table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    .popup th,
    .popup td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .popup th:first-child,
    .popup td:first-child {
        width: 40px;
    }

    .popup img {
        max-width: 100px;
        max-height: 100px;
    }

    .popup button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .popup button:hover {
        background-color: #45a049;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }
</style>

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
        <div class="card mb-4">
            <div class="card-header"><span class="small ms-1">Quản lý đơn hàng</span></div>
            <div class="card-body">
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">

                        <input type="text" id="themDanhMuc" placeholder="Tên danh mục">
                        <button id="buttonInsert" onclick="insertCategories()">Thêm danh mục cho trang chủ</button>
                        <div id="resultCate"></div>
                        <br>
                        <select id="danhMucSelect">
                        </select>

                        <button id="addButton" style="margin-left: 20px;" onclick="openPopup()">Thêm sản phẩm vào danh mục</button>
                        <button id="buttonDel" style="margin-left: 20px;" onclick="delCategories()">Xóa danh mục cho trang chủ</button>

                        <div id="popup" class="popup">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm...">
                            <div id="popupContent" class="popup-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Chọn</th>
                                            <th>Tên</th>
                                            <th>Hãng</th>
                                            <th>Hình ảnh</th>
                                            <th>Mô tả sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <button onclick="addSelectedProducts()">Thêm</button>
                        </div>

                        <div id="overlay" class="overlay"></div>
                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var addedProducts = [];

        function insertCategories() {
            var name = document.getElementById('themDanhMuc').value;
            fetch(`{{ route('categories.insert', ['categoryName' => 'name']) }}`.replace('name', name))
                .then(response => response.json())
                .then(data => {
                    location.reload();
                    var result = document.getElementById('resultCate');
                    result.textContent = data.message;
                });
        }

        function delCategories() {
            var categoryId = document.getElementById('danhMucSelect').value;
            fetch(`{{ route('categories.delete', ['category' => 'categoryId']) }}`.replace('categoryId', categoryId))
                .then(response => response.json())
                .then(data => {
                    location.reload();
                });
        }


        function getCategories() {
            fetch(`{{ route('categories.index') }}`)
                .then(response => response.json())
                .then(data => {
                    var select = document.getElementById('danhMucSelect');
                    data.forEach(category => {
                        var option = document.createElement('option');
                        option.value = category.category_id;
                        option.text = category.name;
                        select.appendChild(option);
                    });
                });
        }

        function openPopup() {
            checkedBox();
            var popup = document.getElementById('popup');
            popup.style.display = 'block';
            overlay.style.display = 'block';
            var searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', searchProducts);

            fetch(`{{ route('products.index') }}`)
                .then(response => response.json())
                .then(data => {
                    var popupContent = document.getElementById('popupContent');
                    popupContent.innerHTML = '';

                    var table = document.createElement('table');
                    var thead = document.createElement('thead');
                    var tbody = document.createElement('tbody');

                    var tr = document.createElement('tr');
                    var th1 = document.createElement('th');
                    th1.textContent = 'Chọn';
                    var th2 = document.createElement('th');
                    th2.textContent = 'Tên';
                    var th3 = document.createElement('th');
                    th3.textContent = 'Hãng';
                    var th4 = document.createElement('th');
                    th4.textContent = 'Hình ảnh';
                    var th5 = document.createElement('th');
                    th5.textContent = 'Mô Tả Sản Phẩm';

                    tr.appendChild(th1);
                    tr.appendChild(th2);
                    tr.appendChild(th3);
                    tr.appendChild(th4);
                    tr.appendChild(th5);
                    thead.appendChild(tr);
                    table.appendChild(thead);

                    data.forEach(product => {
                        var tr = document.createElement('tr');
                        var td1 = document.createElement('td');
                        var checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.value = product.id_prd;
                        checkbox.id = 'product_' + product.id_prd;
                        if (addedProducts.includes(product.id_prd)) {
                            checkbox.checked = true;
                        }
                        td1.appendChild(checkbox);

                        var td2 = document.createElement('td');
                        var label = document.createElement('label');
                        label.htmlFor = 'product_' + product.id_prd;
                        label.textContent = product.name_prd;
                        td2.appendChild(label);

                        var td3 = document.createElement('td');
                        var label = document.createElement('label');
                        label.htmlFor = 'product_' + product.id_prd;
                        label.textContent = product.brand_prd;
                        td3.appendChild(label);

                        var td4 = document.createElement('td');
                        var image = document.createElement('img');
                        image.src = '/template_admin/assets/img/' + product.img_prd;
                        image.alt = product.img_prd;
                        image.width = 100;
                        image.height = 100;
                        td4.appendChild(image);

                        var td5 = document.createElement('td');
                        var label = document.createElement('label');
                        label.htmlFor = 'product_' + product.id_prd;
                        label.textContent = product.desc_prd;
                        td5.appendChild(label);

                        tr.appendChild(td1);
                        tr.appendChild(td2);
                        tr.appendChild(td3);
                        tr.appendChild(td4);
                        tr.appendChild(td5);
                        tbody.appendChild(tr);
                    });

                    table.appendChild(tbody);
                    popupContent.appendChild(table);
                });
        }

        function searchProducts() {
            var searchInput = document.getElementById('searchInput');
            var filter = searchInput.value.toUpperCase();
            var table = document.querySelector('#popupContent table');
            var rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                var name = row.querySelector('td:nth-child(2) label').textContent.toUpperCase();
                if (name.indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            var overlay = document.getElementById('overlay');

            popup.style.display = 'none';
            overlay.style.display = 'none';

        }
        document.addEventListener('click', function(event) {
            var popup = document.getElementById('popup');
            var overlay = document.getElementById('overlay');
            var addButton = document.getElementById('addButton');
            if (!popup.contains(event.target) && event.target !== addButton) {
                closePopup();
            }
        });

        function checkedBox() {
            var categoryId = document.getElementById('danhMucSelect').value;
            fetch(`{{ route('categories.checkbox', ['category' => 'categoryId']) }}`.replace('categoryId', categoryId))
                .then(response => response.json())
                .then(data => {
                    addedProducts = data.product_ids;
                });
        }

        function addSelectedProducts() {
            var categoryId = document.getElementById('danhMucSelect').value;
            console.log(categoryId);
            var selectedProducts = [];
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => selectedProducts.push(checkbox.value));

            fetch(`{{ route('categories.addProducts', ['category' => 'categoryId']) }}`.replace('categoryId', categoryId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        selected_products: selectedProducts
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    var result = document.getElementById('result');
                    result.textContent = data.message;
                });
            closePopup()
        }

        document.addEventListener('DOMContentLoaded', function() {
            getCategories();
        });
    </script>

    @endsection