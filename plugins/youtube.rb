# Use it like: {% youtube Hj33WNhLqOU 640 510 %}

module Jekyll
  class Youtube < Liquid::Tag

    def initialize(name, text, tokens)
      super
      if text =~ /(\w+)\s+(\d+)?\s+(\d+)?/
        @id = $1
        @w = 640
        @h = 510
        if $3
          @w = $2
          @h = $3
        end
      end
    end

    def render(context)
      %(<iframe width="#{@w}" height="#{@h}" src="http://www.youtube.com/embed/#{@id}" frameborder="0" allowfullscreen></iframe>)
    end
  end
end

Liquid::Template.register_tag('youtube', Jekyll::Youtube)
