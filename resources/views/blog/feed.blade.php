@php echo '<'.'?xml version="1.0" encoding="UTF-8"?>'; @endphp
<rss version="2.0" 
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:media="http://search.yahoo.com/mrss/">
    
    <channel>
        <title>Blog Shopp Reparos - Dicas e Soluções</title>
        <link>{{ url('/blog') }}</link>
        <description>Descubra dicas práticas, tutoriais especializados e soluções inteligentes para todos os seus projetos de reparo e manutenção.</description>
        <language>pt-br</language>
        <copyright>© {{ date('Y') }} Shopp Reparos. Todos os direitos reservados.</copyright>
        <managingEditor>contato@shoppreparos.com.br (Shopp Reparos)</managingEditor>
        <webMaster>contato@shoppreparos.com.br (Shopp Reparos)</webMaster>
        <lastBuildDate>{{ now()->toRFC2822String() }}</lastBuildDate>
        <atom:link href="{{ url('/blog/feed') }}" rel="self" type="application/rss+xml" />
        
        @foreach($posts as $post)
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ route('blog.show', $post->slug) }}</link>
            <description><![CDATA[{{ $post->excerpt }}]]></description>
            <content:encoded><![CDATA[{{ $post->content }}]]></content:encoded>
            <author>{{ $post->author_name }}</author>
            <category>{{ $post->category }}</category>
            <pubDate>{{ $post->published_at->toRFC2822String() }}</pubDate>
            <guid isPermaLink="true">{{ route('blog.show', $post->slug) }}</guid>
            @if($post->featured_image)
            <media:content url="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" type="image/jpeg" />
            <enclosure url="{{ \App\Helpers\BlogHelper::getImageUrl($post->featured_image) }}" type="image/jpeg" />
            @endif
        </item>
        @endforeach
        
    </channel>
</rss>
