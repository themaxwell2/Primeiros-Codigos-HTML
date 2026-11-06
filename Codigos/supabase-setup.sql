create table if not exists public.participants (
    id uuid primary key default gen_random_uuid(),
    name text not null check (char_length(trim(name)) between 1 and 80),
    pix text not null check (char_length(trim(pix)) between 1 and 2048)
);

create unique index if not exists participants_name_unique
    on public.participants (lower(name));

alter table public.participants enable row level security;

grant select on public.participants to anon, authenticated;
grant insert, update, delete on public.participants to authenticated;

drop policy if exists "Anyone can view demo participants" on public.participants;
create policy "Anyone can view demo participants"
    on public.participants
    for select
    to anon, authenticated
    using (true);

drop policy if exists "Authenticated admins can manage participants" on public.participants;
create policy "Authenticated admins can manage participants"
    on public.participants
    for all
    to authenticated
    using (true)
    with check (true);

do $$
begin
    if not exists (
        select 1
        from pg_publication_tables
        where pubname = 'supabase_realtime'
          and schemaname = 'public'
          and tablename = 'participants'
    ) then
        alter publication supabase_realtime add table public.participants;
    end if;
end
$$;
