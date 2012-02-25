require 'open-uri'
require 'nokogiri'
require 'pretty-xml'

URL = 'http://www.idris-music.nl/gastenboek.html'

def main
  doc = read_gastenboek URL
  #find_comments doc
  comments = create_comments doc
  xml = create_xml comments
  xml = PrettyXML::write(xml)
  puts xml
end

def read_gastenboek url
  open(url) do |f|
    Nokogiri::HTML(f.read) do |config|
      config.default_xml.noblanks
    end
  end
end

def find_comments doc
  comment = (doc/"//center/table[@border='0']/tr/td")[3]
  lines = comment.children
  result = lines
    .collect do |x| x.to_s.strip end
    .reject do |x| x.empty? end
    .drop_while do |x| not x.downcase.start_with?("<b>reactie") end
    .drop(1)
    .take_while do |x| not x.downcase.start_with?("<b>") end
    .join
  puts result
  exit
end

def create_comments doc
  comments = (doc.xpath "//center/table[@border='0'][@cellpadding='0']/tr/td")
    .collect do |elem| Comment.new elem end
    .select do |comment| comment.valid? end
end

def create_xml comments
  Nokogiri::XML::Builder.new do |xml|
    xml.comments {
      comments.select do |x| x.valid?
      end.each do |x|
        xml.comment {
          xml.name x.name
          xml.from x.from
          xml.content x.content
          xml.date x.date
        }
      end
    }
  end.to_xml
end

class Comment
  def initialize node
    @items = node.children
  end
  def name ; select "naam:" ; end
  def from ; select "woonplaats:" ; end
  def content ; select "reactie:" ; end
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
    not name.empty? and not content.empty?
  end
end

main
