@if ($child['img'] === '')
    <div class="w-full mt-[10px]">
        <a href="<?= $child['url'] ?>" title="<?= $child['name'] ?>"
            class="flex gap-20 items-center w-fit text-title-1 font-bold">
            <?= htmlspecialchars($child['name']) ?>
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path style="fill:#000000;"
                    d="M6.76502 5.43501C7.07752 5.74751 7.07752 6.25501 6.76502 6.56751L1.96502 11.3675C1.65252 11.68 1.14502 11.68 0.83252 11.3675C0.52002 11.055 0.52002 10.5475 0.83252 10.235L5.06752 6.00001L0.835019 1.76501C0.522519 1.45251 0.522519 0.945007 0.835019 0.632507C1.14752 0.320007 1.65502 0.320007 1.96752 0.632507L6.76752 5.43251L6.76502 5.43501Z"
                    fill="#000000" />
            </svg>
        </a>
    </div>
@else
    <a href="<?= $child['url'] ?>"
        class="relative overflow-hidden rounded-[15px] before:content-[''] before:absolute before:w-[300px] before:h-[200px] before:bg-[rgb(55,55,55,0.4)]">
        <img class="w-[300px] h-[200px]" src="{{ asset($child['img']) }}" alt="<?= $child['name'] ?>">
        <p class="flex gap-20 items-center absolute bottom-[14px] left-[14px] text-white text-title-1 font-bold">
            <?= htmlspecialchars($child['name']) ?>
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.76502 5.43501C7.07752 5.74751 7.07752 6.25501 6.76502 6.56751L1.96502 11.3675C1.65252 11.68 1.14502 11.68 0.83252 11.3675C0.52002 11.055 0.52002 10.5475 0.83252 10.235L5.06752 6.00001L0.835019 1.76501C0.522519 1.45251 0.522519 0.945007 0.835019 0.632507C1.14752 0.320007 1.65502 0.320007 1.96752 0.632507L6.76752 5.43251L6.76502 5.43501Z"
                    fill="white" />
            </svg>
        </p>
    </a>
@endif