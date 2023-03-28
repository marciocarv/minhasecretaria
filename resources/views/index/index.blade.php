@extends('layouts.site')

@section('content')
<section class="is-title-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <ul>
      <li>Início</li>
      <li>Minha Secretaria</li>
    </ul>
  </div>
</section>

<section class="section main-section">

<div class="flex flex-wrap">
  <div class="w-full lg:w-6/12 xl:w-2/12 m-2">
    <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg bg-teal-900 hover:bg-teal-700">
      <a href="{{route('inactive')}}" class="">
      <div class="flex-auto p-4">
        <div class="flex flex-wrap">
          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
            <span class="font-bold uppercase text-sm text-white">
            Arquivo Inativo
            </span>
          </div>
          <div class="relative w-auto pl-4 flex-initial">
            <div class="text-teal-900 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
              <i class="fa-solid fa-box-archive"></i>
            </div>
          </div>
        </div>
        <p class="text-sm text-white mt-4 uppercase">
          <span class="text-blue-500 mr-2">
          </span>
          <span class="whitespace-no-wrap">
            
          </span>
        </p>
      </div>
    </a>
    </div>
  </div>

  <div class="w-full lg:w-6/12 xl:w-2/12 m-2">
    <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg bg-teal-900 hover:bg-teal-700">
      <a href="{{route('employee')}}" class="">
      <div class="flex-auto p-4">
        <div class="flex flex-wrap">
          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
            <span class="font-bold uppercase text-sm text-white">
            Servidores
            </span>
          </div>
          <div class="relative w-auto pl-4 flex-initial">
            <div class="text-teal-900 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
              <i class="fa-solid fa-users"></i>
            </div>
          </div>
        </div>
        <p class="text-sm text-white mt-4 uppercase">
          <span class="text-blue-500 mr-2">
          </span>
          <span class="whitespace-no-wrap">
            
          </span>
        </p>
      </div>
    </a>
    </div>
  </div>

  <div class="w-full lg:w-6/12 xl:w-2/12 m-2">
    <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg bg-teal-900 hover:bg-teal-700">
      <a href="#" class="">
      <div class="flex-auto p-4">
        <div class="flex flex-wrap">
          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
            <span class="font-bold uppercase text-sm text-white">
            Livro de ponto
            </span>
          </div>
          <div class="relative w-auto pl-4 flex-initial">
            <div class="text-teal-900 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
              <i class="fa-solid fa-address-book"></i>
            </div>
          </div>
        </div>
        <p class="text-sm text-white mt-4 uppercase">
          <span class="text-blue-500 mr-2">
          </span>
          <span class="whitespace-no-wrap">
            
          </span>
        </p>
      </div>
    </a>
    </div>
  </div>

  <div class="w-full lg:w-6/12 xl:w-2/12 m-2">
    <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg bg-teal-900 hover:bg-teal-700">
      <a href="#" class="">
      <div class="flex-auto p-4">
        <div class="flex flex-wrap">
          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
            <span class="font-bold uppercase text-sm text-white">
            Ofícios
            </span>
          </div>
          <div class="relative w-auto pl-4 flex-initial">
            <div class="text-teal-900 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
              <i class="fa-solid fa-file-lines"></i>
            </div>
          </div>
        </div>
        <p class="text-sm text-white mt-4 uppercase">
          <span class="text-blue-500 mr-2">
          </span>
          <span class="whitespace-no-wrap">
            
          </span>
        </p>
      </div>
    </a>
    </div>
  </div>

  
    <div class="w-full lg:w-6/12 xl:w-2/12 m-2">
      <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg bg-teal-900 hover:bg-teal-700">
        <a href="#" class="">
        <div class="flex-auto p-4">
          <div class="flex flex-wrap">
            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
              <span class="font-bold uppercase text-sm text-white">
              Alunos
              </span>
            </div>
            <div class="relative w-auto pl-4 flex-initial">
              <div class="text-teal-900 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
            </div>
          </div>
          <p class="text-sm text-white mt-4 uppercase">
            <span class="text-blue-500 mr-2">
            </span>
            <span class="whitespace-no-wrap">
              
            </span>
          </p>
        </div>
        </a>
      </div>
    </div>
  </div>


  <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Aniversariantes do mês
            </h3>
            <h1>
              <ul>
                <li>teste</li>
              </ul>
            </h1>
          </div>
          <span class="text-green-500 icon widget-icon"><i class="mdi mdi-account-multiple mdi-48px"></i></span>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Sales
            </h3>
            <h1>
              $7,770
            </h1>
          </div>
          <span class="text-blue-500 icon widget-icon"><i class="mdi mdi-cart-outline mdi-48px"></i></span>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Performance
            </h3>
            <h1>
              256%
            </h1>
          </div>
          <span class="text-red-500 icon widget-icon"><i class="mdi mdi-finance mdi-48px"></i></span>
        </div>
      </div>
    </div>
  </div>

  <div class="card has-table">
    <header class="card-header">
      <p class="card-header-title">
        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
        Clients
      </p>
      <a href="#" class="card-header-icon">
        <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
    </header>
    <div class="card-content">
      <table>
        <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Company</th>
          <th>City</th>
          <th>Progress</th>
          <th>Created</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Rebecca Bauch</td>
          <td data-label="Company">Daugherty-Daniel</td>
          <td data-label="City">South Cory</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="79">79</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Oct 25, 2021">Oct 25, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/felicita-yundt.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Felicita Yundt</td>
          <td data-label="Company">Johns-Weissnat</td>
          <td data-label="City">East Ariel</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="67">67</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Jan 8, 2021">Jan 8, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/mr-larry-satterfield-v.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Mr. Larry Satterfield V</td>
          <td data-label="Company">Hyatt Ltd</td>
          <td data-label="City">Windlerburgh</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="16">16</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Dec 18, 2021">Dec 18, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/mr-broderick-kub.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Mr. Broderick Kub</td>
          <td data-label="Company">Kshlerin, Bauch and Ernser</td>
          <td data-label="City">New Kirstenport</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="71">71</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Sep 13, 2021">Sep 13, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/barry-weber.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Barry Weber</td>
          <td data-label="Company">Schulist, Mosciski and Heidenreich</td>
          <td data-label="City">East Violettestad</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="80">80</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Jul 24, 2021">Jul 24, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/bert-kautzer-md.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Bert Kautzer MD</td>
          <td data-label="Company">Gerhold and Sons</td>
          <td data-label="City">Mayeport</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="62">62</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Mar 30, 2021">Mar 30, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/lonzo-steuber.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Lonzo Steuber</td>
          <td data-label="Company">Skiles Ltd</td>
          <td data-label="City">Marilouville</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="17">17</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Feb 12, 2021">Feb 12, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/jonathon-hahn.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Jonathon Hahn</td>
          <td data-label="Company">Flatley Ltd</td>
          <td data-label="City">Billiemouth</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="74">74</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Dec 30, 2021">Dec 30, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/ryley-wuckert.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Ryley Wuckert</td>
          <td data-label="Company">Heller-Little</td>
          <td data-label="City">Emeraldtown</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="54">54</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Jun 28, 2021">Jun 28, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td class="image-cell">
            <div class="image">
              <img src="https://avatars.dicebear.com/v2/initials/sienna-hayes.svg" class="rounded-full">
            </div>
          </td>
          <td data-label="Name">Sienna Hayes</td>
          <td data-label="Company">Conn, Jerde and Douglas</td>
          <td data-label="City">Jonathanfort</td>
          <td data-label="Progress" class="progress-cell">
            <progress max="100" value="55">55</progress>
          </td>
          <td data-label="Created">
            <small class="text-gray-500" title="Mar 7, 2021">Mar 7, 2021</small>
          </td>
          <td class="actions-cell">
            <div class="buttons right nowrap">
              <button class="button small green --jb-modal"  data-target="sample-modal-2" type="button">
                <span class="icon"><i class="mdi mdi-eye"></i></span>
              </button>
              <button class="button small red --jb-modal" data-target="sample-modal" type="button">
                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
              </button>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
      <div class="table-pagination">
        <div class="flex items-center justify-between">
          <div class="buttons">
            <button type="button" class="button active">1</button>
            <button type="button" class="button">2</button>
            <button type="button" class="button">3</button>
          </div>
          <small>Page 1 of 3</small>
        </div>
      </div>
    </div>
  </div>
</section>
          
@endsection

@section('script')
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '658339141622648');
  fbq('track', 'PageView');
</script>
@endsection