import PerfectScrollbar from 'perfect-scrollbar';
import { inicializarPreenchimentoDeCep } from './plugins/endereco';
import generateTable from './plugins/datatables';
import { handleAllEventListeners } from './events';
import Pristine from 'pristinejs';

const { href } = location;
const base_url = href.includes('localhost') ? 'http://localhost/worthshop/painel/' : 'https://www.atacadoworthshop.com.br/catalogo/painel/';
// const base_url = href.includes('localhost') ? 'http://localhost/worthshop/painel/' : 'https://worthshop.jltecno.com.br/painel/';

let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const navbarToggler = document.getElementById('custom-navbar-toggler');
const navbarIcon = document.getElementById('custom-navbar-icon');
const sidebar = document.getElementsByClassName('custom-sidebar')[0];
const content = document.getElementsByClassName('main-panel')[0];
const scrollbar = document.getElementById('perfect-scrollbar');
const urlFields = document.querySelectorAll('.url-box');
const purchasesProducts = document.querySelectorAll('.purchases-products');
const changeStatusPurshase = document.querySelectorAll('.change-status-purshase');
const editImage = document.querySelectorAll('.edit_image');
const editModalCatalog = document.getElementById('edit_modal_catalog');
const brand = document.querySelectorAll('.edit_brand');
const category = document.querySelectorAll('.edit_category');
const catalogPage = document.querySelectorAll('.edit_catalog');
const editColor = document.querySelectorAll('.edit_color');
const editSize = document.querySelectorAll('.edit_size');
const removeImage = document.querySelectorAll('.removeImage');
const addColor = document.getElementById('add_color');
const addSize = document.getElementById('add_size');
const add_pricing_policy = document.getElementById('add_pricing_policy');
const div_pricing_policy = document.getElementById('div_pricing_policy');
const inputImage = document.querySelectorAll('.input_product_image');

window.onload = () => {
  const productForm = document.getElementById('product-form');
  const productFormValidation = productForm && new Pristine(productForm, false, false);

  generateTable('tabelaUm');
  generateTable('tabelaDois');
  generateTable('tabelaTres');
  handleAllEventListeners();

  productForm?.addEventListener("submit", event => {
    event.preventDefault();

    const isValid = productFormValidation.validate();

    if (isValid) {
      productForm.submit();
    }
    console.log('isValid', isValid)
  });

  if (scrollbar) new PerfectScrollbar(scrollbar);
}

navbarToggler?.addEventListener('click', () => {
  toggleNavbarState(navbarToggler, navbarIcon, sidebar, content);
});

const toggleNavbarState = (element, icon, target, content) => {
  if (element.classList.contains('active')) {
    target.style.transform = 'translate(-100%)';
    content.style.transform = 'translateX(0)';
    icon.classList = 'fas fa-caret-square-right';
    element.classList.remove('active');
  } else {
    target.style.transform = 'translate(0)';
    content.style.transform = 'translateX(138px)';
    icon.classList = 'fas fa-caret-square-left';
    element.classList.add('active');
  }
};

if (/catalogos\/detalhe/.test(window.location.href)) {
  const model = document.getElementById('catalog-model');
  const target = document.getElementById('reference_fields');

  model.addEventListener('change', () => {
    //? reseto o conteúdo desejado toda vez que mudo o select model
    target.innerHTML = '';

    //? obtenhos os atributos data-product-quantity e data-col pra organizar
    //? os elementos posteriormente
    const productQuantity = model.options[model.selectedIndex].dataset.productQuantity;
    const columnSize = model.options[model.selectedIndex].dataset.col;
    for (let i = 0; i < +productQuantity; ++i) {
      //? crio elementos vazios, pra depóis preenchê-los
      const column = document.createElement('div');
      const select = document.createElement('select');
      const label = document.createElement('label');
      const image = document.createElement('img');

      //? defino classes, ids, srcs e textos dos elementos
      column.className = `col-md-${columnSize}`;
      label.textContent = 'Selecione a referência';
      select.className = 'form-select select-catalog-model';
      select.id = `select_model_${i}`;
      select.name = 'reference[]';
      image.id = `image_model_${i}`;
      image.src = base_url + 'storage/products_images/noimage.jpeg';
      image.className = 'image-model';
      select.dataset.imageId = image.id;

      //? insiro label, selects e imagens dentro da variavel column
      column.append(label, select, image);
      target.append(column);
    }

    fetchImageProduct('.select-catalog-model');
    listProducts('.select-catalog-model');
  });
}

//  document.addEventListener('DOMContentLoaded', () => {
//    const select = document.getElementById('select_reference');
//    $(select).select2();
//  })

//  const myModal = new bootstrap.Modal(document.getElementById('pageRegister'))

$('.valor').maskMoney({
  prefix: '',
  decimal: '.',
  thousands: '',
});

$('.valor').on('paste', function () {
  $(this).val("");
});

// $('.valor').mask('000.000.000.000.000,00', {reverse: true});

Array.from(purchasesProducts).forEach((value) => {
  value.addEventListener('click', () => {
    const id = value.dataset.id;
    document.getElementById('id_purchase_product_delete').value = id;
  });
});

Array.from(changeStatusPurshase).forEach((value) => {
  value.addEventListener('click', () => {
    const status = value.dataset.status;
    document.getElementById('status').value = status;
  });
});

Array.from(editImage).forEach((elem) => {
  elem.addEventListener('click', () => {
    editFile(elem)
  });
});

function editFile(elem) {
  const id = elem.dataset.id;
  const name = elem.dataset.name;

  document.getElementById('id').value = id;
  document.getElementById('edit_image_name').value = name;
}


editModalCatalog && editModalCatalog.addEventListener('click', () => {
  editCatalog(editModalCatalog);
});

function editCatalog(editModalCatalog) {
  const id = editModalCatalog.dataset.id;
  const friendly_url = editModalCatalog.dataset.friendly_url;
  const review_name = editModalCatalog.dataset.review_name;
  const cover = editModalCatalog.dataset.cover;

  document.getElementById('id_catalog').value = id;
  document.getElementById('friendly_url').value = friendly_url;
  document.getElementById('review_name').value = review_name;
  document.getElementById('cover').value = cover;
}

Array.from(brand).forEach(elem => {
  elem.addEventListener('click', () => {
    let id = elem.dataset.id;
    let description = elem.dataset.description;

    document.getElementById('id_brand').value = id;
    document.getElementById('edit_brand').value = description;
  });
});

Array.from(category).forEach(elem => {
  elem.addEventListener('click', () => {
    let id = elem.dataset.id;
    let description = elem.dataset.description;

    document.getElementById('id_category').value = id;
    document.getElementById('edit_category').value = description;
  });
});

Array.from(catalogPage).forEach(elem => {
  elem.addEventListener('click', () => {
    editCatalogPage(elem);
    setTimeout(function () {
      fetchImageProduct('.select-edit-catalog-model');
    }, 1000);
  });
});

Array.from(editColor).forEach(elem => {
  elem.addEventListener('click', () => {
    let id = elem.dataset.id;
    let description = elem.dataset.description;

    document.getElementById('id_color').value = id;
    document.getElementById('edit_color').value = description;
  });
});

Array.from(editSize).forEach(elem => {
  elem.addEventListener('click', () => {
    let id = elem.dataset.id;
    let description = elem.dataset.description;

    document.getElementById('id_size').value = id;
    document.getElementById('edit_size').value = description;
  });
});

Array.from(removeImage).forEach(elem => {
  elem.addEventListener('click', () => {
    let idFile = elem.dataset.id;

    document.getElementById('idFile').value = idFile;
  });
});

addColor && addColor.addEventListener('click', () => {
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(xhttp.responseText);
      const colors = document.getElementById('colors');
      const div = document.createElement('div');
      const formGroup = document.createElement('div');
      const label = document.createElement('label');
      const select = document.createElement('select');
      const option = document.createElement('option');

      div.append(formGroup);
      formGroup.append(label, select);
      select.append(option);
      Array.from(data).forEach(value => {
        const option = document.createElement('option');
        option.value = value.id;
        option.textContent = value.description;
        select.append(option);
      });

      div.className = 'col-md-12';
      formGroup.className = 'form-group';
      label.textContent = 'Cor';
      select.className = 'form-control';
      select.name = 'color[]';

      colors.append(div);
    }
  };
  xhttp.open('POST', base_url + 'produtos/fetchColors', true);
  xhttp.setRequestHeader('X-CSRF-TOKEN', csrf_token);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send();
});

addSize && addSize.addEventListener('click', () => {
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(xhttp.responseText);
      const sizes = document.getElementById('sizes');
      const div = document.createElement('div');
      const formGroup = document.createElement('div');
      const label = document.createElement('label');
      const select = document.createElement('select');
      const option = document.createElement('option');

      div.append(formGroup);
      formGroup.append(label, select);
      select.append(option);
      Array.from(data).forEach(value => {
        const option = document.createElement('option');
        option.value = value.id;
        option.textContent = value.description;
        select.append(option);
      });

      div.className = 'col-md-12';
      formGroup.className = 'form-group';
      label.textContent = 'Tamanhos';
      select.className = 'form-control';
      select.name = 'size[]';

      sizes.append(div);
    }
  };
  xhttp.open('POST', base_url + 'produtos/fetchSize', true);
  xhttp.setRequestHeader('X-CSRF-TOKEN', csrf_token);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send();
});

function editCatalogPage(elem) {
  const target = document.getElementById('edit_reference_fields');

  const id_catalogPage = elem.dataset.id;
  const number_page = elem.dataset.number_page;
  const background = elem.dataset.background;

  document.getElementById('id_catalog_pages').value = id_catalogPage;
  document.getElementById('number_page').value = number_page;
  document.getElementById('editBackground').value = background;

  const qtd_model = elem.dataset.model;
  const catalogModel = document.getElementById('edit-catalog-model');
  catalogModel.value = qtd_model;

  let id_product = [];
  let imageProduct = [];
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const data = JSON.parse(xhttp.responseText);
      Array.from(data).forEach((value, index) => {
        // seto valores e texto para as opções dentro do select
        target.innerHTML = '';
        const productQuantity = catalogModel.options[catalogModel.selectedIndex].dataset.productQuantity;
        const columnSize = catalogModel.options[catalogModel.selectedIndex].dataset.col;

        for (let i = 0; i < +productQuantity; i++) {
          //? crio elementos vazios, pra depóis preenchê-los
          const column = document.createElement('div');
          const select = document.createElement('select');
          const label = document.createElement('label');
          const image = document.createElement('img');

          //? defino classes, ids, srcs e textos dos elementos
          column.className = `col-md-${columnSize}`;
          label.textContent = 'Selecione a referência';
          select.className = 'form-select select-edit-catalog-model';
          select.name = 'reference[]';
          image.id = `edit_image_model_${i}`;
          image.className = 'image-model';
          select.dataset.imageId = `edit_image_model_${i}`;
          //? insiro label, selects e imagens dentro da variavel column
          column.append(label, select, image);
          target.append(column);
          imageProduct[index] = `${base_url}storage/${value.img}`;
        }
        id_product[index] = value.id_product;
      });
      listProducts('.select-edit-catalog-model', id_product, imageProduct);
    }
  };
  xhttp.open('POST', base_url + 'catalogos/dados_pagina', true);
  xhttp.setRequestHeader('X-CSRF-TOKEN', csrf_token);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send('id=' + id_catalogPage);
}

function listProducts(classSelectCatalog, id_product = null, image = null) {
  const selectModel = document.querySelectorAll(classSelectCatalog);

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // seto valores e texto para as opções dentro do select
      Array.from(selectModel).forEach(elem => {
        let data = JSON.parse(xhttp.responseText);
        elem.append(document.createElement('option'));

        Array.from(data).forEach(value => {
          const option = document.createElement('option');
          option.value = value.id;
          option.textContent = value.name;
          elem.append(option);
        });
      });
      if (id_product != null) {
        id_product.forEach((product, index) => {
          selectModel[index].value = product;
          const imageProduct = document.getElementById('edit_image_model_' + index);
          imageProduct.src = image[index];
        });
      }
    }
  };
  xhttp.open('POST', base_url + 'catalogos/procurar_produtos', true);
  xhttp.setRequestHeader('X-CSRF-TOKEN', csrf_token);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send();
}

function fetchImageProduct(classSelectModel) {
  const selectModel = document.querySelectorAll(classSelectModel);

  selectModel.forEach(elem => {
    elem.addEventListener('change', () => {
      const elementOption = elem.options[elem.selectedIndex].value;
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          let data = JSON.parse(xhttp.responseText);
          const image = document.getElementById(elem.dataset.imageId);
          image.src = `${base_url}storage/${data.img}`;
        }
      };
      xhttp.open('POST', base_url + 'catalogos/procurar_produto', true);
      xhttp.setRequestHeader('X-CSRF-TOKEN', csrf_token);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send('id=' + elementOption);
    });
  });
}

urlFields && Array.from(urlFields).forEach(urlField => {
  const urlCopier = urlField.querySelector('.url-copier');
  const urlValue = urlField.querySelector('.url-value');
  const originalText = urlCopier.textContent;

  urlCopier.addEventListener('click', () => copyCatalogUrl(urlCopier, originalText, urlValue))

  const copyCatalogUrl = (button, text, field) => {
    navigator.clipboard.writeText(field.textContent).then(() => {
      const copiedText = 'Copiado!';

      if (button.textContent == copiedText) return;

      button.textContent = copiedText;
      setTimeout(() => button.textContent = text, 2000);

    }, (err) => {
      alert(`Não foi possível copiar o texto, erro: ${err}`);
    });
  };
});

const btnModalRemove = document.querySelectorAll('.questionRemove');
btnModalRemove && Array.from(btnModalRemove).forEach(elem => {
  elem.addEventListener('click', () => {
    const classPolicy = elem.dataset.remove;
    const idPolicy = elem.dataset.id;

    document.querySelector('.removePolicy').dataset.remove = classPolicy;
    document.querySelector('#id_policy').value = idPolicy;
  });
});

const btnRemovePolicy = document.querySelector('.removePolicy');
btnRemovePolicy && btnRemovePolicy.addEventListener('click', () => {
  const classPolicy = btnRemovePolicy.dataset.remove;
  const idPolicy = document.getElementById('id_policy').value;

  removePolicyPrice(idPolicy);

  document.querySelector(`.${classPolicy}`).innerHTML = '';
});

const removePolicyPrice = async (idPolicy) => {
  const CSRFToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  const formData = new FormData();
  formData.append('idPolicy', idPolicy);
  formData.append('_method', "DELETE");

  try {
    const request = await fetch(`${base_url}produtos/removePolicy`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': CSRFToken,
      },
      body: formData,
    });
    const json = await request.json();
    console.log('formData', formData);
  } catch (error) {
    console.log('error', error)
    // alert('Ops.. Ocorreu algum erro!');
  }
}

function appendPricingPolicyFields() {
  const pricingPolicyLength = document.getElementById('div_pricing_policy').children.length || 0;

  div_pricing_policy.insertAdjacentHTML('beforeend', `
    <div class="row">
      <div class="col-md-4">
        <label for="start_quantity_${pricingPolicyLength}">Qtd inicial</label>
        <div class="form-group">
          <input type="text" class="form-control" id="start_quantity_${pricingPolicyLength}" name="start_quantity[]" value="" min="1" max="1" data-pristine-min-message="O valor inicial precisa ser 1"
          data-pristine-max-message="O valor inicial precisa ser 1"
          data-pristine-required-message="Este campo é obrigatório" required>
        </div>
      </div>
      <div class="col-md-4">
        <label for="end_quantity_${pricingPolicyLength}">Qtd final</label>
        <div class="form-group">
          <input type="text" class="form-control" id="end_quantity_${pricingPolicyLength}" name="end_quantity[]" value="" min="1" data-pristine-min-message="A quantidade precisa ser positiva" data-pristine-required-message="Este campo é obrigatório" required>
        </div>
      </div>
      <div class="col-md-4">
        <label for="unit_value_${pricingPolicyLength}">Valor un.</label>
        <div class="form-group">
          <input type="text" class="form-control valor" id="unit_value_${pricingPolicyLength}" min="0.01" data-pristine-min-message="O valor deste campo precisa ser positivo" data-pristine-required-message="Este campo é obrigatório" name="price[]" value="" required>
        </div>
      </div>
    </div>
  `);
  $('.valor').mask("#.##0,00", { reverse: true });
}

add_pricing_policy?.addEventListener('click', () => {
  appendPricingPolicyFields();
});

const generateImagePreview = (elem) => {
  elem.addEventListener('change', (_event) => {
    const imageOutput = document.getElementById(elem.dataset.imageOutput);
    const classImage = elem.dataset.classImage;
    const [file] = document.querySelector(`#${classImage}`).files;

    if (file && imageOutput) {
      imageOutput.src = URL.createObjectURL(file);
    }
  });
};

inputImage && Array.from(inputImage).forEach(elem => generateImagePreview(elem));

const addImageProduct = document.getElementById('add_image_product');
addImageProduct && addImageProduct.addEventListener('click', () => {
  const sectionImagesProduct = document.getElementById('sectionImagesProduct');
  let countImages = document.querySelectorAll('.input_product_image');

  const divCol = document.createElement('div');
  const divImage = document.createElement('div');
  const label = document.createElement('label');
  const img = document.createElement('img');
  const input = document.createElement('input');

  divCol.className = 'col-lg-3';
  divImage.className = 'image-box-preview';
  label.className = 'image-preview-label';
  label.setAttribute('for', `input_product_image_${Array.from(countImages).length++}`);
  img.className = `image-preview input_product_image_${Array.from(countImages).length++}`;
  img.id = `image-output-${Array.from(countImages).length++}`;
  img.src = `${base_url}public/img/noimage.jpeg`;
  input.className = `d-none input_product_image`;
  input.type = 'file';
  input.id = `input_product_image_${Array.from(countImages).length++}`;
  input.name = 'input_product_image[]';
  input.dataset.classImage = `input_product_image_${Array.from(countImages).length++}`;
  input.dataset.imageOutput = img.id;

  generateImagePreview(input);

  sectionImagesProduct.append(divCol);
  divCol.append(divImage);
  divImage.append(label, input);
  label.append(img);
});

const updateImageProduct = document.querySelectorAll('.update-image-product');
Array.from(updateImageProduct).forEach(elem => {
  elem.addEventListener('click', () => {
    const id = elem.dataset.id;
    const classImage = elem.dataset.classImage;

    document.getElementById('id_image').value = id;
    document.getElementById('classImage').value = classImage;
  });
});

const btnDeleteImage = document.getElementById('deleteImageProduct');
btnDeleteImage && btnDeleteImage.addEventListener('click', () => {
  deleteImageProduct();
});

const deleteImageProduct = async () => {
  const CSRFToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  let classImage = document.getElementById('classImage').value;

  const formData = new FormData();
  formData.append('id_image', document.getElementById('id_image').value);
  formData.append('id_product', document.getElementById('id_product').value);
  formData.append('_method', "DELETE");

  try {
    const request = await fetch(`${base_url}produtos/deleteImageProduct`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': CSRFToken,
      },
      body: formData,
    });
    document.getElementById(classImage).innerHTML = '<p class="text-danger">Removido com sucesso!!</p>';
    setTimeout(() => {
      document.getElementById(classImage).innerHTML = '';
    }, 2000);

    // const json = await request.json();
  } catch (error) {
    console.log('error', error);
  }

}

const buttonNewColor = document.getElementById('addNewColor');
buttonNewColor?.addEventListener('click', () => {
  const oldColor = document.getElementById('oldColor');
  const divNewColor = document.getElementById('divNewColor');
  let hide = buttonNewColor.dataset.hide

  if (hide == 'on') {
    oldColor.style.display = 'none'
    divNewColor.style.display = '';
    buttonNewColor.dataset.hide = 'off';
    buttonNewColor.textContent = 'Adicionar cor existente';
  } else {
    oldColor.style.display = ''
    divNewColor.style.display = 'none';
    buttonNewColor.dataset.hide = 'on';
    buttonNewColor.textContent = 'Adicionar nova cor';
  }
})

const removeSubProduct = document.querySelectorAll('.removeSubProduct');
Array.from(removeSubProduct)?.forEach((elem) => {
  elem.addEventListener('click', () => {
    const id = elem.dataset.id;

    document.getElementById('id_subproduct').value = id;
  });
});

const removeCategory = document.querySelectorAll('.removeCategory');
Array.from(removeCategory).forEach((elem) => {
  elem.addEventListener('click', () => {
    const id = elem.dataset.id;

    document.getElementById('id_category_remove').value = id;
  });
});

const removeBrand = document.querySelectorAll('.removeBrand');
Array.from(removeBrand).forEach((elem) => {
  elem.addEventListener('click', () => {
    const id = elem.dataset.id;

    document.getElementById('id_brand_remove').value = id;
  });
});

const removeColor = document.querySelectorAll('.removeColor');
Array.from(removeColor).forEach((elem) => {
  elem.addEventListener('click', () => {
    const id = elem.dataset.id;

    document.getElementById('id_color_remove').value = id;
  });
});

const removeSize = document.querySelectorAll('.removeSize');
Array.from(removeSize).forEach((elem) => {
  elem.addEventListener('click', () => {
    const id = elem.dataset.id;

    document.getElementById('id_size_remove').value = id;
  });
});
