<x-frontend.layouts.master>
@push('css')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

        <!-- Start Main Top -->
        <x-frontend.layouts.partials.startMainTop/>
        <!-- End Main Top -->

        <!-- Start Main Top -->
        <x-frontend.layouts.partials.header/>
        <!-- End Main Top -->

        <!-- Start Top Search -->
        <x-frontend.layouts.partials.topSearch/>
        <!-- End Top Search -->



        <div class="flex bg-white p-4">
      <div class="w-60 h-fit border rounded p-3">
        <h1 class="font-bold text-lg text-gray-700">Categories</h1>
        <div id="category-list"></div>
      </div>
      <div
        class="flex-1 flex flex-wrap mx-auto justify-center lg:gap-10 gap-6"
        id="card-container"
      >
        <script>
          // Sample data for cards
          const products = [
            {
              name: "Product 1",
              description: "Description for product 1.",
              price: "$100",
              imageUrl:
                "https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D",
            },
            {
              name: "Product 2",
              description: "Description for product 2.",
              price: "$120",
              imageUrl:
                "https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D",
            },
            {
              name: "Product 3",
              description: "Description for product 3.",
              price: "$140",
              imageUrl:
                "https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D",
            }
          ];

          const container = document.getElementById("card-container");

          products.forEach((product) => {
            const card = document.createElement("div");
            card.className = "w-64 h-80 shadow-md rounded overflow-hidden hover:-mt-2 transition-all duration-300";

            card.innerHTML = `
                    <div class="w-full h-1/2">
                        <img
                            class="h-full w-full object-cover hover:scale-105 transition-all duration-300"
                            src="${product.imageUrl}"
                            alt=""
                        />
                    </div>
                    <div class="p-4 flex flex-col justify-between h-40">
                        <div>
                            <h1 class="font-semibold text-slate-800 text-center cursor-pointer">${product.name}</h1>
                            <p class="text-sm leading-5 text-center">
                                ${product.description}
                            </p>
                        </div>
                        <div class="flex w-full justify-between">
                            <p class="text-red-400 font-semibold tracking-wider">${product.price}</p>
                            <button
                                class="border border-teal-400 hover:bg-teal-400 transition all duration-150 hover:text-white font-semibold rounded px-4 text-xs py-1"
                            >
                                ADD TO CART
                            </button>
                        </div>
                    </div>
                `;

            container.appendChild(card);
          });
        </script>
      </div>
    </div>
  </body>
  <script>
    const categories = [
        "All",
        "Electronics",
        "Clothing",
        "Books",
        "Home Goods",
        "Toys",
    ];

    function generateCategoryList(categoryArray, containerId) {
        const categoryList = document.getElementById(containerId);
        let htmlContent = '';
        categoryArray.forEach((category) => {
            htmlContent += `
                <div class="flex items-center my-2">
                    <input type="checkbox" class="mr-2">
                    <label>${category}</label>
                </div>
            `;
        });
        categoryList.innerHTML = htmlContent;
    }
    // Call the function to generate the category list
    generateCategoryList(categories, "category-list");
</script>





        <!-- Start Footer  -->
        <x-frontend.layouts.partials.footer/>
        <!-- End Footer  -->

</x-frontend.layouts.master>
