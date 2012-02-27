require 'open-uri'
require 'nokogiri'
require 'pretty-xml'

URL = 'http://www.idris-music.nl/gastenboek.html'

def main
  doc = read_guestbook URL
  entries = parse_entries doc
  xml = create_xml entries
  xml = PrettyXML::write(xml)
  puts xml
end

def read_guestbook url
  open(url) do |f|
    Nokogiri::HTML(f.read) do |config|
      config.default_xml.noblanks
    end
  end
end

def parse_entries doc
  (doc.xpath "//center/table[@border='0'][@cellpadding='0']/tr/td")
    .collect do |elem| Entry.new elem end
    .select do |elem| elem.valid? end
end

def create_xml entries
  Nokogiri::XML::Builder.new do |xml|
    xml.guestbook {
      entries.each do |x|
        xml.entry {
          xml.name x.name
          xml.from x.from
          xml.comment x.comment
          xml.date x.date
        }
      end
    }
  end.to_xml
end

class Entry
  def initialize node
    @items = node.children
  end
  def name ; select "naam:" ; end
  def from ; select "woonplaats:" ; end
  def comment ; select "reactie:" ; end
  def date ; select "tijd:" ; end
  def to_s
    name
  end
  def select pattern
    @items
      .collect do |x| x.to_s.strip end
      .reject do |x| x.empty? end
      .drop_while do |x| not x.downcase.start_with?("<b>" + pattern) end
      .drop(1)
      .take_while do |x| not x.downcase.start_with?("<b>") end
      .join
  end
  def valid?
    not name.empty? and not comment.empty?
  end
end

main
