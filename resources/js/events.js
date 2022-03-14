const handleProductVariationListening = () => {
  const registerProductVariationModal = document.getElementById(
    "modal_add_variation_info"
  );
  const editProductVariationModal = document.getElementById(
    "modal_edit_variation_info"
  );

  registerProductVariationModal?.addEventListener("show.bs.modal", (event) => {
    const { relatedTarget, target } = event;
    const { title: dataTitle, id: dataId } = relatedTarget.dataset;
    const modalTitle = target.querySelector("#color-modal-title");
    const subProduct = target.querySelector("#sub-product");

    modalTitle.textContent = dataTitle
      ? `Adição de dados da variação ${dataTitle}`
      : modalTitle.textContent;

    subProduct.value = dataId;
  });

  editProductVariationModal?.addEventListener("show.bs.modal", (event) => {
    const { relatedTarget, target } = event;
    const { title, quantity, description, id, idvariation } = relatedTarget.dataset;
    console.log(idvariation);
    const modalTitle = target.querySelector("#color-modal-title");
    const modalFieldSize = target.querySelector("#edit-modal-variation-size");
    const subProduct = target.querySelector("#sub-product");
    const idVariationInput = target.querySelector("#id-variation");
    const modalFieldQuantity = target.querySelector(
      "#edit-modal-variation-quantity"
    );

    modalTitle.textContent = title
      ? `Edição da variação ${title}`
      : modalTitle.textContent;

    modalFieldSize.value = description;
    modalFieldQuantity.value = quantity;
    subProduct.value = id;
    idVariationInput.value = idvariation;
  });
};

const handleProductQuantityValidationListening = () => {
  
}

export const handleAllEventListeners = () => {
  handleProductQuantityValidationListening();
  handleProductVariationListening();
};