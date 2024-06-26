<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Whatsapp-Atendimento</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"/>

</head>
<body class="body">
@if (isset($error))
        <div class="modal" id="Error"  tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atenção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{$error}}</p>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"> 
            <img class="logoNav" src="images/logogalago.png"/>
            <div class="logado" >


            </div>
        </div>
        <div class="btn-group btn-group-sm" role="group" aria-label="Logout">
            <a type="button" class="btn btn-outline-warning" id="logout" href="/logout" >
                <img src="/images/logoutSVG.SVG" class="logout" alt="...">
            </a>
        </div>  
    </nav> 
    <div class="container-fluid" style="display: flex; justify-content: center; margin: 0.5rem 0rem 0rem;">
        <a type="button" class="btn btn-secondary" id="btMenu" onclick='href="/PaginaPrincipal"'>Pagina Principal</a>
    </div>
  <div class="main-wrapper">
    <div class="container">
      <div class="page-content">
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-4 col-12 card-stacked" style="padding:0;">
              <div class="card shadow-line mb-3 chat">
                <div class="chat-user-detail">
                  <div class="p-3 chat-header">
                    <div class="w-100">
                      <div class="d-flex pl-0">
                        <div class="d-flex flex-row mt-1 mb-1">
                          <span class="margin-auto mr-2">
                            <a href="#" class="user-undetail-trigger btn btn-sm btn-icon btn-light active text-dark ml-2">
                              <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                                <polyline points="15 18 9 12 15 6"></polyline>
                              </svg>
                            </a>
                          </span>
                          <p class="margin-auto fw-400 text-dark-75">Profile</p>
                        </div>
                        <div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="p-3 chat-user-info">
                    <div class="card-body text-center">
                      <a href="#!">
                        <img src="https://user-images.githubusercontent.com/35243461/168796876-2e363a49-b32c-4218-b5a3-ce12493af69e.jpg" class="rounded-circle img-fluid shadow avatar-xxl">
                      </a>
                      <div class="pt-4 text-center animate4">
                        <h6 class="fw-300 mb-1">Quan Albert</h6>
                        <p class="text-muted">Web Developer</p>
                        <div class="mt-4">
                          <a href="#" class="btn btn-light-skype btn-icon btn-circle btn-sm btn-shadow mr-2"><i class="bx bxl-skype"></i></a>
                          <a href="#" class="btn btn-light-facebook btn-icon btn-circle btn-sm btn-shadow mr-2"><i class="bx bxl-facebook"></i></a>
                          <a href="#" class="btn btn-light-twitter btn-icon btn-circle btn-sm btn-shadow mr-2"><i class="bx bxl-twitter"></i></a>
                          <a href="#" class="btn btn-light-instagram btn-icon btn-circle btn-sm btn-shadow mr-2"><i class="bx bxl-instagram"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="p-3 chat-header">
                  <div class="d-flex">
                    <div class="w-100 d-flex pl-0">
                      <img class="user-detail-trigger rounded-circle shadow avatar-sm mr-3 chat-profile-picture" src="https://user-images.githubusercontent.com/35243461/168796876-2e363a49-b32c-4218-b5a3-ce12493af69e.jpg" />
                    </div>
                    <div class="flex-shrink-0 margin-auto">
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                          <polyline points="17 2 12 7 7 2"></polyline>
                        </svg>
                      </a>
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <path d="M12 20h9"></path>
                          <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                      </a>
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <circle cx="12" cy="12" r="1"></circle>
                          <circle cx="12" cy="5" r="1"></circle>
                          <circle cx="12" cy="19" r="1"></circle>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="chat-search pl-3 pr-3">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search a conversation">
                    <div class="input-group-append prepend-white">
                      <span class="input-group-text pl-2 pr-2">
                        <i class="fs-17 las la-search drop-shadow"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="archived-messages d-flex p-3">
                  <div class="w-100">
                    <div class="d-flex pl-0">
                      <div class="d-flex flex-row mt-1">
                        <span class="margin-auto mr-2">
                          <div class="svg15 archived"></div>
                        </span>
                        <p class="margin-auto fw-400 text-dark-75">Archived</p>
                      </div>
                      <div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chat-user-panel">
                  <div class="pb-3 d-flex flex-column navigation-mobile pagination-scrool chat-user-scroll">
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle shadow avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796884-ee3aafb6-8083-48ec-9cfb-51b95eae08fe.jpg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Emily Woods</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">I'm looking forward to it</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">08:55</p>
                          <div class="text-right d-flex flex-row">
                            <span>
                              <div class="svg18 pinned"></div>
                            </span>
                            <i class="text-muted la la-angle-down ml-1 fs-15"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item active d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle shadow avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796877-f6c8819a-5d6e-4b2a-bd56-04963639239b.jpg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Beate Lemoine</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check"></div>
                              </span>
                              <span class="message-shortcut margin-auto fw-400 fs-13 ml-1 mr-4">Hey Quan, If you are free now we can meet tonight ?</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">08:21</p>
                          <span class="round badge badge-light-success margin-auto">2</span>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle shadow avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796879-f8c5e585-15c0-49ff-94de-c70539ae434c.jpg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Tessa Nau</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 single-check"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">No that's everyhing, thanks again! </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">04:21</p>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle shadow avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796872-7251e655-cdf0-4031-a253-bf0db09cdf0f.jpg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Eric Campos</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check-blue"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">So cool, I'll let you know if anything else is needed </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">03:47</p>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796904-de09be7a-511c-4ae6-8312-4e81b8721555.svg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Lone Rangers</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check-blue"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">
                                <div class="d-flex flex-row text-muted">
                                  <span>Diego</span>:
                                  <span class="message-shortcut margin-auto fs-13 ml-1 mr-4">So cool, I'll let you know if anything else is needed </span>
                                </div>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">01:15</p>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle shadow avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796882-28875c5c-424a-40d4-8f69-cfb7f18ccd14.jpg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Luis Hamilton</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">no problem</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">yesterday</p>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796906-ab4fc0f3-551c-4036-b455-be2dfedb9680.svg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Joel Lehtinen</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">find it hard to believe you don't know</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">4.10.2021</p>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle shadow avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796881-383d6cc9-a4cc-402f-b730-e9edc4e1e9b7.jpg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">James Tolonen</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 single-check"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">All your life</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">6.10.2021</p>
                        </div>
                      </div>
                    </div>
                    <div class="chat-item d-flex pl-3 pr-0 pt-3 pb-3">
                      <div class="w-100">
                        <div class="d-flex pl-0">
                          <img class="rounded-circle avatar-sm mr-3" src="https://user-images.githubusercontent.com/35243461/168796906-ab4fc0f3-551c-4036-b455-be2dfedb9680.svg">
                          <div>
                            <p class="margin-auto fw-400 text-dark-75">Cory Bryant</p>
                            <div class="d-flex flex-row mt-1">
                              <span>
                                <div class="svg15 double-check-blue"></div>
                              </span>
                              <span class="message-shortcut margin-auto text-muted fs-13 ml-1 mr-4">12-year journey to visit more asteroids than any other</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="flex-shrink-0 margin-auto pl-2 pr-3">
                        <div class="d-flex flex-column">
                          <p class="text-muted text-right fs-13 mb-2">1.9.2021</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-12 card-stacked" style="padding:0;">
              <div class="card shadow-line mb-3 chat chat-panel">
                <div class="p-3 chat-header">
                  <div class="d-flex">
                    <div class="w-100 d-flex pl-0">
                      <img class="rounded-circle shadow avatar-sm mr-3 chat-profile-picture" src="https://user-images.githubusercontent.com/35243461/168796877-f6c8819a-5d6e-4b2a-bd56-04963639239b.jpg">
                      <div class="mr-3">
                        <a href="!#">
                          <p class="fw-400 mb-0 text-dark-75">Beate Lemoine</p>
                        </a>
                        <p class="sub-caption text-muted text-small mb-0"><i class="la la-clock mr-1"></i>last seen today at 09:15 PM</p>
                      </div>
                    </div>
                    <div class="flex-shrink-0 margin-auto">
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <circle cx="12" cy="12" r="10"></circle>
                          <line x1="12" y1="16" x2="12" y2="12"></line>
                          <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                      </a>
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <polygon points="23 7 16 12 23 17 23 7"></polygon>
                          <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                      </a>
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <circle cx="11" cy="11" r="8"></circle>
                          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                      </a>
                      <a href="#" class="btn btn-sm btn-icon btn-light active text-dark ml-2">
                        <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="feather">
                          <circle cx="12" cy="12" r="1"></circle>
                          <circle cx="12" cy="5" r="1"></circle>
                          <circle cx="12" cy="19" r="1"></circle>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-row mb-3 navigation-mobile scrollable-chat-panel chat-panel-scroll">
                  <div class="w-100 p-3">
                    <div class="svg36 loader-animate3 horizontal-margin-auto mb-2"></div>
                    <div class="text-center letter-space drop-shadow text-uppercase fs-12 w-100 mb-3">Today</div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Hi, Quan</p>
                      <div class="message-options">
                        <div class="message-time">06:15</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="mb-0 mr-3 pr-4">
                          <div class="d-flex flex-row">
                            <div class="pr-2">Hey, Beate</div>
                            <div class="pr-4"></div>
                          </div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">06:49</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Oh hey, I didn’t see you there. Did you already get a table?</p>
                      <div class="message-options">
                        <div class="message-time">06:52</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">I just want to ask</p>
                      <div class="message-options">
                        <div class="message-time">06:53</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="mb-0 mr-3 pr-4">
                          <div class="d-flex flex-row">
                            <div class="pr-2">Yeah, right over here.</div>
                            <div class="pr-4"></div>
                          </div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">06:53</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">I’m glad we had time to meet up.</p>
                      <div class="message-options">
                        <div class="message-time">06:54</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="mb-0 mr-3 pr-4">
                          <div class="d-flex flex-row">
                            <div class="pr-2">;)</div>
                            <div class="pr-4"></div>
                          </div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">06:57</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="mb-0 mr-3 pr-4">
                          <div class="d-flex flex-row">
                            <div class="pr-4">Me too. So, what’s going on?</div>
                            <div class="pr-4"></div>
                          </div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">06:57</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Oh, not much. You?</p>
                      <div class="message-options">
                        <div class="message-time">07:05</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="d-flex flex-row">
                          <div class="pr-2">Not much. Hey, how did your interview go? Wasn’t that today?</div>
                          <div class="pr-4"></div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">07:06</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Oh, yeah. I think it went well. I don’t know if I got the job yet, but they said they would call in a few days.</p>
                      <div class="message-options">
                        <div class="message-time">07:09</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="mb-0 mr-3 pr-4">
                          <div class="d-flex flex-row">
                            <div class="pr-2">Well, I’m sure you did great. Good luck.</div>
                            <div class="pr-4"></div>
                          </div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">07:12</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Thanks. I’m just happy that it’s over. I was really nervous about it.</p>
                      <div class="message-options">
                        <div class="message-time">07:16</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="d-flex flex-row-reverse mb-2">
                      <div class="right-chat-message fs-13 mb-2">
                        <div class="d-flex flex-row">
                          <div class="pr-2">I can understand that. I get nervous before interviews, too</div>
                          <div class="pr-4"></div>
                        </div>
                        <div class="message-options dark">
                          <div class="message-time">
                            <div class="d-flex flex-row">
                              <div class="mr-2">07:21</div>
                              <div class="svg15 double-check"></div>
                            </div>
                          </div>
                          <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Well, thanks for being supportive. I appreciate it.</p>
                      <div class="message-options">
                        <div class="message-time">07:24</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                    <div class="left-chat-message fs-13 mb-2">
                      <p class="mb-0 mr-3 pr-4">Hey Quan, If you are free now we can meet tonight ?</p>
                      <div class="message-options">
                        <div class="message-time">08:21</div>
                        <div class="message-arrow"><i class="text-muted la la-angle-down fs-17"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chat-search pl-3 pr-3">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Write a message">
                    <div class="input-group-append prepend-white">
                      <span class="input-group-text pl-2 pr-2">
                        <i class="chat-upload-trigger fs-19 bi bi-file-earmark-plus ml-2 mr-2"></i>
                        <i class="fs-19 bi bi-emoji-smile ml-2 mr-2"></i>
                        <i class="fs-19 bi bi-camera ml-2 mr-2"></i>
                        <i class="fs-19 bi bi-cursor ml-2 mr-2"></i>
                        <div class="chat-upload">
                          <div class="d-flex flex-column">
                            <div class="p-2">
                              <button type="button" class="btn btn-secondary btn-md btn-icon btn-circle btn-blushing">
                                <i class="fs-15 bi bi-camera"></i>
                              </button>
                            </div>
                            <div class="p-2">
                              <button type="button" class="btn btn-success btn-md btn-icon btn-circle btn-blushing">
                                <i class="fs-15 bi bi-file-earmark-plus"></i>
                              </button>
                            </div>
                            <div class="p-2">
                              <button type="button" class="btn btn-warning btn-md btn-icon btn-circle btn-blushing">
                                <i class="fs-15 bi bi-person"></i>
                              </button>
                            </div>
                            <div class="p-2">
                              <button type="button" class="btn btn-danger btn-md btn-icon btn-circle btn-blushing">
                                <i class="fs-15 bi bi-card-image"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>

  

</body>
</html>