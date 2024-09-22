<div class="w-[300px] h-screen overflow-auto bg-white fixed z-auto">
    <div class="flex items-center px-6 flex-shrink-0 py-10">
        <a href="#" class="no-underline">
            <h2 class="font-bold leading-7 text-3xl text-gray-900">Purniture - Admin</h2>
        </a>
    </div>
    <ul class="flex-1 px-6 space-y-2 overflow-hidden hover:overflow-auto w-full">
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{ route('admin.index') }}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">Dashboard</a>
        </li>
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{ route('admin.user.index') }}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">khách
                hàng
            </a>
        </li>
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group">
            <a href="{{ route('admin.products.index') }}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">
                Danh mục sản phẩm
            </a>
        </li>

        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{ route('admin.vouchers.index') }}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">Vorcher</a>
        </li>
        
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{route('admin.reviews.index')}}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">Đánh
                giá
            </a>
        </li>
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{ route('admin.orders.index') }}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">Quản lý đơn hàng
            </a>
        </li>
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="#"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">
            </a>
        </li>
        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{route('admin.configs.editBackgroundColor')}}"
            class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">Quản
            lý trang chủ
        </a>
    </li>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <li class="w-full hover:bg-pink-50 duration-150 py-2 hover:px-2 group"><a href="{{ route('admin.logout') }}"
                class="block w-full leading-5 font-normal no-underline text-gray-500 group-hover:text-[#FF6281] rounded-md">Đăng xuất
            </a>
        </li>
    </ul>
</div>
