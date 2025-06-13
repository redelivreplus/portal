@extends('layouts.app')

@section('styles')
<style>
  .hero-section {
    background-color: #156DAF;
    color: white;
    text-align: center;
    padding: 50px 0;
  }

  .hero-section h1 {
    font-size: 3rem;
  }

  .hero-section p {
    font-size: 1.2rem;
  }

  .btn-primary {
    background-color: #f5a623;
    border: none;
    color: white;
    font-size: 1rem;
    padding: 12px 30px;
    cursor: pointer;
    text-decoration: none;
  }

  .btn-primary:hover {
    background-color: #e59420;
  }
</style>
@endsection

@section('content')
  <!-- Seção Hero -->
  <section class="hero-section">
  
  
  
  
    <h1>Bem-vindo ao Rede Livre GO!</h1>
    <p>Conectando você ao conteúdo de qualidade. Explore agora as nossas opções.</p>
    <a href="#" class="btn-primary">Saiba mais</a>
  </section>
@endsection
