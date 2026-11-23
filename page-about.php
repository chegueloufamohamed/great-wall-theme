<?php
/**
 * Template Name: Our Story
 * The template for displaying the Our Story / About page (slug: about)
 *
 * @package great-wall-theme
 */

get_header();
?>

  <!-- ==========================================================================
       DYNAMIC PAGE HEADER BANNER
       ========================================================================== -->
  <section class="page-banner" style="background-color: var(--bg-dark); color: #FFFFFF; padding: 140px 0 80px; text-align: center;">
    <div class="container">
      <h1 class="page-banner-title" style="font-family: var(--font-serif); font-size: 3rem; font-weight: 300; margin-bottom: 12px;">
        <?php esc_html_e( 'Our Story', 'great-wall-theme' ); ?>
      </h1>
      <div class="breadcrumbs" style="display: flex; justify-content: center; gap: 8px; font-size: 0.85rem; color: var(--color-accent-light);">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'great-wall-theme' ); ?></a>
        <span>/</span>
        <span><?php esc_html_e( 'Our Story', 'great-wall-theme' ); ?></span>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       OUR STORY BODY CONTENT (ENGLISH & CHINESE)
       ========================================================================== -->
  <section class="section" style="padding: 80px 0; background-color: var(--bg-primary, #FAF8F5);">
    <div class="container">
      <div class="page-content-wrapper" style="max-width: 960px; margin: 0 auto; background: #FFFFFF; padding: 55px 60px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid rgba(230, 223, 213, 0.8); line-height: 1.85; font-size: 1.05rem; color: var(--color-primary, #1E1C19);">

        <!-- ======================== ENGLISH SECTION ======================== -->
        <div class="our-story-lang-block">
          <div style="display: inline-block; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.16em; color: var(--color-accent, #B89566); background: rgba(184, 149, 102, 0.12); padding: 6px 16px; border-radius: 30px; margin-bottom: 18px;">
            About Great Wall Furnitures
          </div>

          <h3 style="font-family: var(--font-sans); font-size: 1.25rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            Founded in 2005 &amp; Core Product Lines
          </h3>
          <p style="margin-bottom: 26px; color: #3D3935;">
            <strong>Great Wall Furnitures Trading LLC</strong> was <strong>founded in 2005</strong> and specializes in <strong>furniture import and export trading in Dubai, UAE</strong>. The company has registered two brands in the UAE (<strong>PILOTEER</strong> and <strong>MOMENT</strong>). Its main products are divided into three categories: <strong>residential furniture</strong>, <strong>office furniture</strong>, and <strong>labor camp series products</strong>.
          </p>

          <h3 style="font-family: var(--font-sans); font-size: 1.25rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            20+ Years of Growth, End-to-End Service &amp; GCC Market Presence
          </h3>
          <p style="margin-bottom: 26px; color: #3D3935;">
            After <strong>more than 20 years</strong> of continuous development and improvement, the company has continued to launch new products and expand its business. It now has a <strong>well-established and independent operating system</strong> that provides customers with comprehensive services and professional support at every stage—from <strong>pre-sale ordering</strong> to <strong>goods transportation and assembly</strong>, and through to <strong>after-sales service</strong>. The company has a <strong>large warehouse</strong> to ensure an ample supply of stored goods; it has <strong>more than ten vehicles</strong> and a <strong>team of dozens of staff</strong>, ensuring that the entire service process—from product inquiry and order confirmation to <strong>timely delivery, installation, and after-sales service</strong>—is completed efficiently. At present, the company holds a <strong>considerable share of the UAE furniture market</strong> and enjoys high recognition in the furniture industry. It also maintains ongoing and close business relationships with customers in <strong>several neighboring Gulf countries</strong>.
          </p>

          <h3 style="font-family: var(--font-sans); font-size: 1.25rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            Oman Branch, Tianjin Headquarters &amp; Self-Operated Factories
          </h3>
          <p style="margin-bottom: 26px; color: #3D3935;">
            In <strong>2018</strong>, the company established a branch in the <strong>Sultanate of Oman</strong>, with its own <strong>showroom and large warehouse</strong>. The company's headquarters is located in <strong>Tianjin, China</strong>, and it owns <strong>two self-operated furniture factories</strong>, enabling effective and reasonable control of <strong>quality and cost</strong>. The company has a <strong>professional foreign trade team</strong> and very stable partner manufacturers across the country, which can meet customers' diverse procurement needs. The company is committed to providing customers with <strong>diversified products at the best value for money</strong>.
          </p>

          <h3 style="font-family: var(--font-sans); font-size: 1.25rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            Long-Term Partnerships &amp; Core Principles
          </h3>
          <p style="margin-bottom: 0; color: #3D3935;">
            Through unremitting efforts, the company has established close and lasting cooperative relationships with <strong>dozens of large multinational groups and enterprises in the UAE</strong>. We sincerely thank our new and old customers for their trust and support of <strong>Great Wall Furnitures Trading LLC</strong>! The company will continue to uphold the principles of <strong>&ldquo;integrity-based, service-first, win-win cooperation, and high cost-effectiveness,&rdquo;</strong> providing customers with all-round, multi-dimensional shopping services and ensuring a <strong>quality shopping experience</strong>.
          </p>
        </div>

        <!-- ======================== DIVIDER ======================== -->
        <hr style="border: 0; border-top: 1px solid rgba(230, 223, 213, 0.95); margin: 45px 0;">

        <!-- ======================== CHINESE SECTION ======================== -->
        <div class="our-story-lang-block" lang="zh-CN">
          <div style="display: inline-block; font-size: 0.78rem; font-weight: 800; letter-spacing: 0.12em; color: #841421; background: rgba(132, 20, 33, 0.08); padding: 6px 16px; border-radius: 30px; margin-bottom: 18px;">
            关于长城家具 · 中文简介
          </div>

          <h3 style="font-family: var(--font-sans); font-size: 1.22rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            品牌创立与三大核心板块
          </h3>
          <p style="margin-bottom: 26px; color: #3D3935;">
            <strong>长城家具贸易有限公司（Great Wall Furnitures Trading LLC）</strong>始于<strong>2005年</strong>，在<strong>阿联酋迪拜</strong>专业从事家具进出口贸易，在阿联酋注册了两个品牌（<strong>PILOTEER</strong> 和 <strong>MOMENT</strong>）。公司主要产品分为<strong>民用家具</strong>、<strong>办公家具</strong>、<strong>劳工营系列产品</strong>三大板块。
          </p>

          <h3 style="font-family: var(--font-sans); font-size: 1.22rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            二十余年稳健发展与全方位运营体系
          </h3>
          <p style="margin-bottom: 26px; color: #3D3935;">
            经过<strong>二十余年</strong>持续发展，公司不断完善，持续推出新产品、拓展新业务，现已拥有<strong>完善且独立的运营体系</strong>，从<strong>售前预订</strong>到<strong>货物运输组装</strong>，再到<strong>售后</strong>，全过程各环节为客户提供全方位的服务和专业保障。公司拥有<strong>大型仓库</strong>，以保证仓储货源充足；拥有<strong>十余辆车</strong>和<strong>数十名团队成员</strong>，可确保从产品询价、确认订单、<strong>及时配送到安装售后</strong>的整体服务高效完成。目前公司在<strong>阿联酋家具市场占据相当份额</strong>，在家具行业具有很高的知名度，并与周边<strong>多个海湾国家</strong>的客户保持持续、密切的业务往来。
          </p>

          <h3 style="font-family: var(--font-sans); font-size: 1.22rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            阿曼分公司、天津总部与自营工厂优势
          </h3>
          <p style="margin-bottom: 26px; color: #3D3935;">
            公司于<strong>2018年</strong>在<strong>阿曼苏丹国</strong>成立分公司，拥有自己的<strong>展厅和大型仓库</strong>。公司总部设立于<strong>中国天津</strong>，持有<strong>两家自营家具工厂</strong>，可以有效、合理地控制<strong>质量和成本</strong>。公司拥有<strong>专业的外贸团队</strong>，在全国各地有非常稳定的合作厂家，可以满足客户的多种采购需求。公司致力于为客户提供<strong>多样化且性价比最高的产品</strong>。
          </p>

          <h3 style="font-family: var(--font-sans); font-size: 1.22rem; font-weight: 800; color: #1E1C19; margin-bottom: 10px;">
            长期战略合作与服务宗旨
          </h3>
          <p style="margin-bottom: 0; color: #3D3935;">
            经过不懈努力，公司与阿联酋<strong>数十家大型跨国集团和企业</strong>建立了密切、持久的合作关系。衷心感谢新老客户对<strong>长城家具贸易有限公司</strong>的信任和支持！公司将继续贯彻<strong>“诚信为本、服务至上、合作共赢、性价比高”</strong>的原则，为客户提供全方位、多维度的购物服务，保障客户的<strong>购物体验</strong>。
          </p>
        </div>

      </div>
    </div>
  </section>

  <style>
    @media (max-width: 768px) {
      .page-content-wrapper {
        padding: 32px 24px !important;
        font-size: 1rem !important;
      }
    }
  </style>

<?php
get_footer();
