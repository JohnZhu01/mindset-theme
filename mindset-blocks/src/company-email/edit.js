import {
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { PanelBody, PanelRow, ToggleControl } from '@wordpress/components';
import { useEntityProp } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';

/**
 * Render the company email block in the editor.
 *
 * @param {Object}   root0               Component properties.
 * @param {Object}   root0.attributes    Block attributes.
 * @param {Function} root0.setAttributes Updates block attributes.
 * @return {Element} Editor component.
 */
export default function Edit( { attributes, setAttributes } ) {
	const postID = 13;
	const [ meta, setMeta ] = useEntityProp(
		'postType',
		'page',
		'meta',
		postID
	);
	const companyEmail = meta?.company_email ?? '';
	const { svgIcon } = attributes;

	const updateEmail = ( value ) => {
		setMeta( { ...( meta ?? {} ), company_email: value } );
	};

	return (
		<>
			<div { ...useBlockProps() }>
				{ svgIcon && (
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="24"
						height="24"
						viewBox="0 0 24 24"
						role="img"
						aria-label={ __( 'Email icon', 'company-email' ) }
					>
						<path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
					</svg>
				) }
				<RichText
					tagName="p"
					value={ companyEmail }
					placeholder={ __(
						'Enter email address…',
						'company-email'
					) }
					onChange={ updateEmail }
					allowedFormats={ [] }
				/>
			</div>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'company-email' ) }>
					<PanelRow>
						<ToggleControl
							label={ __( 'Show email icon', 'company-email' ) }
							checked={ svgIcon }
							onChange={ ( value ) =>
								setAttributes( { svgIcon: value } )
							}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
