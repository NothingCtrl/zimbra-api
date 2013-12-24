<?php

namespace Zimbra\Tests\API;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Enum\ParticipationStatus;

/**
 * Testcase class for account api soap request.
 */
class MailRequestTest extends ZimbraTestCase
{
	public function testAddAppointmentInvite()
	{
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\AddAppointmentInvite(
            ParticipationStatus::NE(), $m
        );
        $this->assertTrue($req->ptst()->is('NE'));
        $this->assertSame($m, $req->m());

        $req->ptst(ParticipationStatus::NE())
        	->m($m);
        $this->assertTrue($req->ptst()->is('NE'));
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddAppointmentInviteRequest ptst="NE">'
	            .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
	                .'<content>content</content>'
	                .'<header name="name">value</header>'
	                .'<mp ct="ct" content="content" ci="ci">'
	                    .'<mp ct="ct" content="content" ci="ci" />'
	                    .'<attach aid="aid">'
	                        .'<mp mid="mid" part="part" optional="1" />'
	                        .'<m id="id" optional="0" />'
	                        .'<cn id="id" optional="0" />'
	                        .'<doc path="path" id="id" ver="1" optional="1" />'
	                    .'</attach>'
	                .'</mp>'
	                .'<attach aid="aid">'
	                    .'<mp mid="mid" part="part" optional="1" />'
	                    .'<m id="id" optional="0" />'
	                    .'<cn id="id" optional="0" />'
	                    .'<doc path="path" id="id" ver="1" optional="1" />'
	                .'</attach>'
	                .'<inv method="method" compNum="1" rsvp="1" />'
	                .'<e a="a" t="t" p="p" />'
	                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
	                    .'<standard mon="1" hour="2" min="3" sec="4" />'
	                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
	                .'</tz>'
	                .'<fr>fr</fr>'
	            .'</m>'
            .'</AddAppointmentInviteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddAppointmentInviteRequest' => array(
                'ptst' => 'NE',
	            'm' => array(
	                'aid' => 'aid',
	                'origid' => 'origid',
	                'rt' => 'rt',
	                'idnt' => 'idnt',
	                'su' => 'su',
	                'irt' => 'irt',
	                'l' => 'l',
	                'f' => 'f',
	                'content' => 'content',
	                'header' => array(
	                    array(
	                        'name' => 'name',
	                        '_' => 'value',
	                    ),
	                ),
	                'mp' => array(
	                    'ct' => 'ct',
	                    'content' => 'content',
	                    'ci' => 'ci',
	                    'mp' => array(
	                        array(
	                            'ct' => 'ct',
	                            'content' => 'content',
	                            'ci' => 'ci',
	                        ),
	                    ),
	                    'attach' => array(
	                        'aid' => 'aid',
	                        'mp' => array(
	                            'mid' => 'mid',
	                            'part' => 'part',
	                            'optional' => 1,
	                        ),
	                        'm' => array(
	                            'id' => 'id',
	                            'optional' => 0,
	                        ),
	                        'cn' => array(
	                            'id' => 'id',
	                            'optional' => 0,
	                        ),
	                        'doc' => array(
	                            'path' => 'path',
	                            'id' => 'id',
	                            'ver' => 1,
	                            'optional' => 1,
	                        ),
	                    ),
	                ),
	                'attach' => array(
	                    'aid' => 'aid',
	                    'mp' => array(
	                        'mid' => 'mid',
	                        'part' => 'part',
	                        'optional' => 1,
	                    ),
	                    'm' => array(
	                        'id' => 'id',
	                        'optional' => 0,
	                    ),
	                    'cn' => array(
	                        'id' => 'id',
	                        'optional' => 0,
	                    ),
	                    'doc' => array(
	                        'path' => 'path',
	                        'id' => 'id',
	                        'ver' => 1,
	                        'optional' => 1,
	                    ),
	                ),
	                'inv' => array(
	                    'method' => 'method',
	                    'compNum' => 1,
	                    'rsvp' => 1,
	                ),
	                'e' => array(
	                    array(
	                        'a' => 'a',
	                        't' => 't',
	                        'p' => 'p',
	                    ),
	                ),
	                'tz' => array(
	                    array(
	                        'id' => 'id',
	                        'stdoff' => 1,
	                        'dayoff' => 1,
	                        'stdname' => 'stdname',
	                        'dayname' => 'dayname',
	                        'standard' => array(
	                            'mon' => 1,
	                            'hour' => 2,
	                            'min' => 3,
	                            'sec' => 4,
	                        ),
	                        'daylight' => array(
	                            'mon' => 4,
	                            'hour' => 3,
	                            'min' => 2,
	                            'sec' => 1,
	                        ),
	                    ),
	                ),
	                'fr' => 'fr',
	            ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
	}

	public function testAddComment()
	{
        $comment = new \Zimbra\Soap\Struct\AddedComment('parentId', 'text');
        $req = new \Zimbra\API\Mail\Request\AddComment(
            $comment
        );
        $this->assertSame($comment, $req->comment());

        $req->comment($comment);
        $this->assertSame($comment, $req->comment());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddCommentRequest>'
                .'<comment parentId="parentId" text="text" />'
            .'</AddCommentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddCommentRequest' => array(
	            'comment' => array(
	                'parentId' => 'parentId',
	                'text' => 'text',
	            ),
            )
        );
        $this->assertEquals($array, $req->toArray());
	}

	public function testAddMsg()
	{
        $m = new \Zimbra\Soap\Struct\AddMsgSpec(
            'content', 'f', 't', 'tn', 'l', true, 'd', 'aid'
        );
        $req = new \Zimbra\API\Mail\Request\AddMsg(
            $m, true
        );
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->filterSent());

        $req->m($m)
        	->filterSent(true);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->filterSent());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddMsgRequest filterSent="1">'
                .'<m f="f" t="t" tn="tn" l="l" noICal="1" d="d" aid="aid">'
	                .'<content>content</content>'
	            .'</m>'
            .'</AddMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddMsgRequest' => array(
            	'filterSent' => 1,
	            'm' => array(
	                'content' => 'content',
	                'f' => 'f',
	                't' => 't',
	                'tn' => 'tn',
	                'l' => 'l',
	                'noICal' => 1,
	                'd' => 'd',
	                'aid' => 'aid',
	            ),
            )
        );
        $this->assertEquals($array, $req->toArray());
	}
}
