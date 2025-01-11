<div class="px-12">
    <div class="py-100">
        <div class="container">
            <x-title-group title="CONTACT US" description="Reach out to book, ask, or collaborate" />
            <div class="px-50 relative flex justify-end">
                <img class="absolute bottom-[-50px] left-[50px] z-0" src="{{ asset('assets/img/contact-1.png') }}"
                    alt="">
                <div
                    class="max-w-[1000px] z-[1] flex items-center p-24 gap-24 bg-white shadow-[9px_14px_45px_1px_rgba(0,0,0,0.15)] rounded-[38px]">
                    <img class="absolute top-[-50px] right-[70px] z-0" src="{{ asset('assets/img/contact-2.png') }}" />
                    <form class="w-full flex flex-wrap gap-24 border-r border-gray-100 pr-24"
                        action="{{ route('contact') }}" method="POST">
                        @csrf
                        <x-text-input required="true" class="w-full" type="text" name="name" placeholder="Name" />
                        <x-text-input required="true" class="w-full" type="email" name="email" placeholder="Email" />
                        <textarea required
                            class="block w-full h-[100px] text-body-1 rounded-[25px] bg-gray-100 px-[16px] py-[10px] border-none outline-none"
                            name="body" id="body" placeholder="Message">
                        </textarea>
                        <x-primary-button type="submit" class="ml-auto">
                            Send
                        </x-primary-button>
                    </form>
                    <div class="relative flex flex-1 flex-wrap gap-24 w-fit h-fit items-center">
                        <div class="flex items-center gap-[12px] h-fit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.9281 19.5506C12.9372 17.0363 17.5194 10.9424 17.5194 7.51946C17.5194 3.36809 14.1513 0 9.99993 0C5.84856 0 2.48047 3.36809 2.48047 7.51946C2.48047 10.9424 7.06264 17.0363 9.07175 19.5506C9.55346 20.1498 10.4464 20.1498 10.9281 19.5506ZM9.99993 5.01297C10.6647 5.01297 11.3022 5.27705 11.7723 5.74711C12.2423 6.21716 12.5064 6.8547 12.5064 7.51946C12.5064 8.18422 12.2423 8.82176 11.7723 9.29181C11.3022 9.76187 10.6647 10.0259 9.99993 10.0259C9.33517 10.0259 8.69763 9.76187 8.22757 9.29181C7.75752 8.82176 7.49344 8.18422 7.49344 7.51946C7.49344 6.8547 7.75752 6.21716 8.22757 5.74711C8.69763 5.27705 9.33517 5.01297 9.99993 5.01297Z"
                                    fill="#8A8A8A" />
                            </svg>
                            <p class="whitespace-nowrap text-gray-500" itemprop="address" itemscope
                                itemtype="https://schema.org/PostalAddress">
                                <span itemprop="streetAddress">130 Dien Bien Phu, Da Nang, Viet Nam</span>
                            </p>
                        </div>
                        <div class="flex items-center gap-[12px] h-fit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.44112 0.961776C6.14035 0.235245 5.34742 -0.151456 4.58964 0.0555658L1.15229 0.993025C0.472635 1.18052 0 1.79768 0 2.50077C0 12.1644 7.83559 20 17.4992 20C18.2023 20 18.8195 19.5274 19.007 18.8477L19.9444 15.4104C20.1515 14.6526 19.7648 13.8596 19.0382 13.5589L15.2884 11.9964C14.6517 11.7308 13.9135 11.9144 13.4799 12.4496L11.9018 14.3752C9.15194 13.0745 6.92548 10.8481 5.62475 8.09818L7.55045 6.52403C8.08558 6.08655 8.26917 5.35221 8.00355 4.71552L6.44112 0.965682V0.961776Z"
                                    fill="#8A8A8A" />
                            </svg>
                            <a class="whitespace-nowrap text-gray-500" href="tel: (+84) 123 456 789"
                                itemprop="telephone">(+84) 123 456 789</a>
                        </div>
                        <div class="flex items-center gap-[12px] h-fit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.875 2.5C0.839844 2.5 0 3.33984 0 4.375C0 4.96484 0.277344 5.51953 0.75 5.875L9.25 12.25C9.69531 12.582 10.3047 12.582 10.75 12.25L19.25 5.875C19.7227 5.51953 20 4.96484 20 4.375C20 3.33984 19.1602 2.5 18.125 2.5H1.875ZM0 6.875V15C0 16.3789 1.12109 17.5 2.5 17.5H17.5C18.8789 17.5 20 16.3789 20 15V6.875L11.5 13.25C10.6094 13.918 9.39063 13.918 8.5 13.25L0 6.875Z"
                                    fill="#8A8A8A" />
                            </svg>
                            <a class="whitespace-nowrap text-gray-500" href="mailto: {{ config('mail.from.address') }}"
                                itemprop="email">{{ config('mail.from.address') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>