# Primeiros-Codigos-HTML
Aprendendo html e colocando meu aprendizado aqui!

## Demonstração compartilhada da Caixinha de Natal

A página `Codigos/pagina_simples.html` usa o Supabase para compartilhar a lista de participantes entre dispositivos. A lista e os dados Pix são públicos nesta demonstração; use apenas informações fictícias.

1. Crie um projeto no [Supabase](https://supabase.com/).
2. No **SQL Editor** do projeto, execute o conteúdo de `Codigos/supabase-setup.sql`.
3. Em **Authentication → Sign In / Providers**, desative o cadastro público de usuários. Crie e confirme a conta do administrador em **Authentication → Users**.
4. Abra `Codigos/supabase-config.js` no editor. No painel do seu projeto Supabase, vá em **Project Settings → API** e copie:
   - **Project URL** para o campo `url`.
   - A chave pública **anon** (projetos antigos) ou **publishable** para o campo `anonKey`.

   Por exemplo, o arquivo ficará com este formato (os valores abaixo são fictícios):

   ```js
   window.CAIXINHA_SUPABASE_CONFIG = {
       url: "https://seu-id-de-projeto.supabase.co",
       anonKey: "sua-chave-publica-anon-ou-publishable"
   };
   ```

   Não invente esses valores: eles são únicos do seu projeto e aparecem no painel Supabase. Se ainda não criou um projeto, primeiro conclua o passo 1. **Nunca** use uma chave `service_role` ou `secret` na página nem a compartilhe: ela dá acesso administrativo.
5. Publique o repositório em um host HTTPS estático. No GitHub Pages, publique a raiz do repositório e use a URL terminada em `/Codigos/pagina_simples.html`. Compartilhe essa URL. A senha de administrador é a senha da conta Supabase criada no passo 3.

O acesso público tem permissão somente de leitura; alterações exigem login. A política de escrita permite qualquer usuário autenticado, portanto mantenha o cadastro público desativado e crie apenas contas de administrador. A lista usa Supabase Realtime para atualizar os outros dispositivos quando há mudanças. Os dados salvos localmente na versão anterior não são migrados automaticamente; cadastre os participantes novamente pela área do administrador.
