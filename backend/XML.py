from lxml import etree

# Create the root element
page = etree.Element('results')

# Make a new document tree
doc = etree.ElementTree(page)

# Add the subelements
pageElement = etree.SubElement(page, 'Country',
                                      name='Germany',
                                      Code='DE',
                                      Storage='Basic')
# For multiple multiple attributes, use as shown above

root = etree.Element("root")
etree.SubElement(root, "child").text = "Child 1"
etree.SubElement(root, "child").text = "Child 2"
etree.SubElement(root, "another").text = "Child 3"

print(etree.tostring(root, pretty_print=True))


# Save to XML file
doc.write('output.xml', xml_declaration=True, encoding='utf-16')

# "<domain type='kvm'>
# < name >$vm_name < / name >
# < memory >$memory < / memory >
# < currentMemory >$memory < / currentMemory >
# < vcpu > ".$vcpu." < / vcpu >
# < os >
# < type
# arch = 'x86_64'
# machine = 'pc' > hvm < / type >
# < boot
# dev = 'cdrom' / >
# < / os >
# < features >
# < acpi / >
# < apic / >
# < pae / >
# < / features >
# < clock
# offset = 'localtime' / >
# < on_poweroff > destroy < / on_poweroff >
# < on_reboot > restart < / on_reboot >
# < on_crash > destroy < / on_crash >
# < devices >
# < emulator > / usr / libexec / qemu - kvm < / emulator >
# < disk
# type = 'file'
# device = 'disk' >
# < driver
# name = 'qemu'
# type = 'qcow2' / >
# < source
# file = '/data/vm/".$vm_name.".qcow2' / >
# < target
# dev = 'hda'
# bus = 'ide' / >
# < / disk >
# < disk
# type = 'file'
# device = 'cdrom' >
# < source
# file = '/data/iso/GamewaveOS-0.4-x86_64.iso' / >
# < target
# dev = 'hdb'
# bus = 'ide' / >
# < readonly / >
# < / disk >
# < interface
# type = 'bridge' >
# < source
# bridge = 'public' / >
# < mac
# address = '$mac1' / >
# < / interface >
# < interface
# type = 'bridge' >
# < source
# bridge = 'public' / >
# < mac
# address = '$mac2' / >
# < / interface >
# < input
# type = 'mouse'
# bus = 'ps2' / >
# < graphics
# type = 'vnc'
# port = '-1'
# autoport = 'yes'
# keymap = 'en-us'
# listen = '0.0.0.0' / >
# < / devices >
# < / domain > ";